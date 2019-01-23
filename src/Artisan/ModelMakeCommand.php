<?php

namespace SlimApp\Artisan;

use Illuminate\Support\Str;
use SlimApp\Artisan\GeneratorCommand;

class ModelMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * The excluded columns for fillable.
     *
     * @var array
     */
    protected $exclude = ['id', 'gid', 'password', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return;
        }

        if ($this->option('all')) {
            $this->setOption('factory', true);
            $this->setOption('migration', true);
            $this->setOption('controller', true);
            $this->setOption('resource', true);
        }

        if ($this->option('factory')) {
            $this->createFactory();
        }

        if ($this->option('migration')) {
            $this->createMigration();
        }

        if ($this->option('controller') || $this->option('resource')) {
            $this->createController();
        }
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replacePropsModel($stub)->replaceClass($stub, $name);
    }

    /**
     * Replace the props of the model for the given stub.
     *
     * @param  string  $stub
     * @return $this
     */
    protected function replacePropsModel(&$stub)
    {
        if ($this->option('plain')) {
            return $this;
        }

        $props = [];

        $table = $this->option('table') ?: str_plural(strtolower($this->getNameInput()));

        // Table Name
        if ($this->option('table')) {
            $props[] = $this->addPropTable($table);
        }

        // Primary Key
        if ($this->option('autopk')) {
            $autopk = $this->addPropAutoPK($table);
            count($autopk) > 0 ? $props[] = $autopk : null;
        } else {
            $primarykey = (null !== $this->option('primarykey') and $this->option('primarykey') != 'id') ? $this->option('primarykey') : false;
            $incrementing = (null !== $this->option('incrementing') and $this->option('incrementing') == false) ? false : true;
            $keytype = (null !== $this->option('keytype') and $this->option('keytype') != 'int') ? $this->option('keytype') : false;

            if ($primarykey or !$incrementing or $keytype) {
                $props[] = $this->addPropPrimaryKey($primarykey, $incrementing, $keytype);
            }
        }

        // Timestamps
        $timestamps = (null !== $this->option('timestamps') and $this->option('timestamps') == false) ? false : true;
        $created_at = (null !== $this->option('created_at') and $this->option('created_at') != 'created_at') ? $this->option('created_at') : false;
        $updated_at = (null !== $this->option('updated_at') and $this->option('updated_at') != 'updated_at') ? $this->option('updated_at') : false;

        if (!$timestamps or $created_at or $updated_at) {
            $props[] = $this->addPropTimestamp($timestamps, $created_at, $updated_at);
        }

        // Mass Assignment
        if ($this->option('autofill')) {
            $props[] = $this->addPropAutoFill($table);
        } else {
            $fillable = (null !== $this->option('fillable')) ? $this->option('fillable') : false;
            $guarded = (null !== $this->option('guarded') and $this->option('guarded') != '*') ? $this->option('guarded') : false;
            $guarded = $fillable ? false : $guarded;

            if ($fillable or $guarded != false) {
                $props[] = $this->addPropMassAssignment($fillable, $guarded);
            }
        }

        $props = implode(PHP_EOL, $props);

        $stub = str_replace('DummyPropsModel', $props, $stub);

        return $this;
    }

    protected function addPropTable($table)
    {

        return PHP_EOL."    /* Table Name */
    protected \$table = '$table';";
    }

    protected function addPropAutoPK($table = null)
    {

        $connection = \DB::schema()->getConnection();
        $grammar = $connection->getSchemaGrammar();

        $results = [];

        if ($grammar instanceof \Illuminate\Database\Schema\Grammars\PostgresGrammar) {
            list($schema, $table) = $this->parseSchemaAndTable($table, $connection);
            $results = $connection->select($this->compileColumnKey('pgsql'), [$schema, $table]);
        } elseif ($grammar instanceof \Illuminate\Database\Schema\Grammars\SqlServerGrammar) {
            //echo 'SqlServer';
        } elseif ($grammar instanceof \Illuminate\Database\Schema\Grammars\SQLiteGrammar) {
            $results = $connection->select($grammar->compileColumnListing($table));
            $results = $this->processColumnKey($results);
        } elseif ($grammar instanceof \Illuminate\Database\Schema\Grammars\MySqlGrammar) {
            $results = $connection->select(
                $this->compileColumnKey('mysql'), [$connection->getDatabaseName(), $table]
            );
        }

        if ($results) {
            //var_dump($results);
            $primaryKey = $results[0]->column_name;
            $incrementing = $results[0]->extra;
            $keyType = $results[0]->data_type;

            $primaryKey = (isset($primaryKey) and $primaryKey != 'id') ? $primaryKey : false;

            $integer = ['biginteger', 'integer', 'mediuminteger', 'smallinteger', 'tinyinteger', 'bigint', 'int', 'mediumint', 'smallint', 'tinyint'];

            $keyType = in_array($keyType, $integer) ? false : 'string';
            if ($primaryKey or !$incrementing or $keyType) {
                return $this->addPropPrimaryKey($primaryKey, $incrementing, $keyType);
            }
        }
        //return $results;
    }

    protected function compileColumnKey($driver)
    {
        switch ($driver)
        {
        case 'mysql':
            return 'select column_name, data_type, extra from information_schema.columns
            where column_key = \'PRI\' and table_schema = ? and table_name = ?';
        case 'pgsql':
            return 'select c.column_name, c.data_type, c.column_default as extra
            from information_schema.table_constraints tc join
            information_schema.constraint_column_usage AS ccu
            USING (constraint_schema, constraint_name)
            join information_schema.columns AS c ON c.table_schema = tc.constraint_schema
            AND tc.table_name = c.table_name AND ccu.column_name = c.column_name
            where constraint_type = \'PRIMARY KEY\' and tc.table_schema = ? and tc.table_name = ?';
        case 'sqlsrv':
            break;
        }
    }

    /**
     * Parse the table name and extract the schema and table.
     *
     * @param  string  $table
     * @param  \Illuminate\Database\Connection  $connection
     * @return array
     */
    protected function parseSchemaAndTable($table, $connection)
    {
        $table = explode('.', $table);
        if (is_array($schema = $connection->getConfig('schema'))) {
            if (in_array($table[0], $schema)) {
                return [array_shift($table), implode('.', $table)];
            }
            $schema = reset($schema);
        }

        if (count($table) > 1) {
            $schema = array_shift($table);
        }

        return [$schema ?: 'public', implode('.', $table)];
    }

    protected function processColumnKey($results)
    {
        return array_map(function ($result) {
            if ($result->pk == '1') {
                return (object)[
                    'column_name' => $result->name,
                    'data_type' => $result->type == 'INTEGER' ? 'int' : 'string',
                    'extra' => false,
                ];
            }
        }, $results);
    }

    protected function addPropPrimaryKey($primaryKey, $incrementing, $keyType)
    {
        $prop = PHP_EOL."    /* Primary Key */";
        if ($primaryKey) {
            $prop .= PHP_EOL."    protected \$primaryKey = '$primaryKey';";
        }

        if (!$incrementing) {
            $prop .= PHP_EOL."    public \$incrementing = false;";
        }

        if ($keyType) {
            $prop .= PHP_EOL."    protected \$keyType = '$keyType';";
        }

        return $prop;
    }

    protected function addPropTimestamp($timestamps, $created_at, $updated_at)
    {
        $prop = PHP_EOL."    /* Timestamps */";
        if (!$timestamps) {
            $prop .= PHP_EOL."    public \$timestamps = false;";
        }

        if ($created_at) {
            $prop .= PHP_EOL."    const CREATED_AT = '$created_at';";
        }

        if ($updated_at) {
            $prop .= PHP_EOL."    const UPDATED_AT = '$updated_at';";
        }

        return $prop;
    }

    protected function addPropAutoFill($table)
    {
        // Get the table columns
        $columns = \DB::schema()->getColumnListing($table);
        // Exclude the unwanted columns
        $columns = array_filter($columns, function ($value) {
            return !in_array($value, $this->exclude);
        });
        // Add quotes
        array_walk($columns, function (&$value) {
            $value = "'" . $value . "'";
        });
        // CSV format
        $columns = implode(',', $columns);

        //return $this->addPropMassAssignment($columns, false);

        return PHP_EOL."    /* Mass Assignment */".PHP_EOL."    protected \$fillable = [$columns];";
    }

    protected function addPropMassAssignment($fillable, $guarded)
    {
        $prop = PHP_EOL."    /* Mass Assignment */";
        if ($fillable) {
            $prop .= PHP_EOL."    protected \$fillable = [$fillable];";
        }

        if ($guarded != false) {
            $prop .= PHP_EOL."    protected \$guarded = [$guarded];";
        }

        return $prop;
    }

    /**
     * Create a model factory for the model.
     *
     * @return void
     */
    protected function createFactory()
    {
        $factory = Str::studly(class_basename($this->option('name')));

        /*$this->call('make:factory', [
            'name' => "{$factory}Factory",
            'model' => $this->qualifyClass($this->getNameInput()),
        ]);*/
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::plural(Str::snake(class_basename($this->option('name'))));

        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }

        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            'create' => $table,
        ]);
    }

    /**
     * Create a controller for the model.
     *
     * @return void
     */
    protected function createController()
    {
        $controller = Str::studly(class_basename($this->option('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:controller', [
            'name' => "{$controller}Controller",
            'model' => $this->option('resource') ? $modelName : null,
            //'resource'  => $this->option('resource') ? true : null,
            //'force'     => $this->option('force'),
        ]);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = null;

        if ($this->option('plain')) {
            $stub = $this->option('pivot') ? '/stubs/pivot.model.plain.stub' : '/stubs/model.plain.stub';
        } else {
            if ($this->option('soft')) {
                $stub = $this->option('pivot') ? '/stubs/pivot.model.soft.stub' : '/stubs/model.soft.stub';
            } else {
                $stub = $this->option('pivot') ? '/stubs/pivot.model.stub' : '/stubs/model.stub';
            }
        }

        return __DIR__.$stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Models';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', 'Generate a migration, factory, and resource controller for the model'],

            ['controller', 'c', 'Create a new controller for the model'],

            ['factory', 'f', 'Create a new factory for the model'],

            ['force', null, 'Create the class even if the model already exists'],

            ['migration', 'm', 'Create a new migration file for the model'],

            ['pivot', 'p', 'Indicates if the generated model should be a custom intermediate table model'],

            ['resource', 'r', 'Indicates if the generated controller should be a resource controller'],

            ['plain', 'p', 'Indicates if the generated model should be a custom empty class'],

            ['soft', 'p', 'Indicates if the generated model use soft deletes'],

            ['table', null, 'Table name of the model'],

            ['primarykey', null, 'Primary Key of the model'],

            ['incrementing', null, 'Indicates if the primary key is auto-incrementing'],

            ['keytype', null, 'Indicates if the key type of the is int or string'],

            ['timestamps', null, 'Indicates if the model have fields created_at and updated_at'],

            ['created_at', null, 'Indicates if the name of created_at field'],

            ['updated_at', null, 'Indicates if the name of updated_at field'],

            ['autofill', null, 'Indicates if the fields fillable have create automatic'],

            ['fillable', null, ''],

            ['guarded', null, ''],

        ];
    }
}


/*
    // Table Names
    protected $table = DummyTable;              //snake_plural

    // Primary Keys
    protected $primaryKey = DummyPrimaryKey;    //'id'
    public $incrementing = DummyIncrementing;   //true
    protected $keyType = DummyKeyType;          //'int'

    // Timestamps
    public $timestamps = DummyTimestamps;       //true
    const CREATED_AT = DummyCreatedAt;          //'created_at'
    const UPDATED_AT = DummyUpdatedAt;          //'updated_at'

    // Database Connection
    protected $connection = DummyConnection;    //default

    // Default Attribute Values
    protected $attributes = DummyAttributes;    //[]

    // Mass Assignment
    protected $fillable = DummyFillable;        //[]
    protected $guarded = DummyGuarded;          //['*']

    // Date Mutators
    protected $dates = DummyDates;              //['created_at', 'updated_at']

    // Hiding Attributes From JSON
    protected $hidden = DummyHidden;            //[]
    protected $visible = DummyVisible;          //[]

*/