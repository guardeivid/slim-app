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
        $props = [];

        $table = $this->option('table') ?: str_plural(strtolower($this->getNameInput()));

        if ($this->option('table')) {
            $props[] = $this->addPropTable($this->option('table'));
        }

        $primarykey = isset($this->option('primarykey')) and $this->option('primarykey') != 'id' ? $this->option('primarykey') : false;
        $incrementing = isset($this->option('incrementing')) and $this->option('incrementing') == false ? false : true;
        $keytype = isset($this->option('keytype')) and $this->option('keytype') != 'int' ? $this->option('keytype') : false;

        if ($primarykey or !$incrementing or $keytype) {
            $props[] = $this->addPropPrimaryKey($primarykey, $incrementing, $keytype);
        }

        $timestamps = isset($this->option('timestamps')) and $this->option('timestamps') == false ? false : true;
        $created_at = isset($this->option('created_at')) and $this->option('keytype') != 'created_at' ? $this->option('created_at') : false;
        $updated_at = isset($this->option('updated_at')) and $this->option('updated_at') != 'updated_at' ? $this->option('updated_at') : false;

        if (!$timestamps or $created_at or $updated_at) {
            $props[] = $this->addPropTimestamp($timestamps, $created_at, $updated_at);
        }

        if ($this->option('autofill')) {
            $props[] = $this->addPropAutoFill($table);
        } else {
            $fillable = isset($this->option('fillable')) ? $this->option('fillable') : false;
            $guarded = isset($this->option('guarded')) and $this->option('guarded') != '*' ? $this->option('guarded') : false;
            $guarded = $fillable ? false : $guarded;

            if ($fillable or $guarded != false) {
                $props[] = $this->addPropMassAssignment($fillable, $guarded);
            }
        }

        $stub = str_replace('DummyPropsModel', $props), $stub);

        return $this;
    }

    protected function addPropTable($table)
    {
        
        return "    /** Table Name */
    protected \$table = '$table';";
    }

    protected function addPropPrimaryKey($primaryKey, $incrementing, $keyType)
    {
        $prop = '    /** Primary Key */';
        if ($primaryKey) {
            $prop .= "\n    protected \$primaryKey = '$primaryKey';"
        }

        if (!$incrementing) {
            $prop .= "\n    public \$incrementing = false;"
        }

        if ($keyType) {
            $prop .= "\n    protected \$keyType = '$keyType';"
        }

        return $prop;
    }

    protected function addPropTimestamp($timestamps, $created_at, $updated_at)
    {
        $prop = '    /** Timestamps */';
        if (!$timestamps) {
            $prop .= "\n    public \$timestamps = false;"
        }

        if ($created_at) {
            $prop .= "\n    const CREATED_AT = '$created_at';"
        }

        if ($updated_at) {
            $prop .= "\n    const UPDATED_AT = '$updated_at';"
        }

        return $prop;
    }

    protected function addPropAutoFill($table)
    {
        // Get the table columns
        $columns = \DB::schema()->getColumnListing($table);
        // Exclude the unwanted columns 
        $columns = array_filter($columns, function($value) {
          return !in_array($value, $this->exclude);
        });
        // Add quotes
        array_walk($columns, function(&amp;$value) {
            $value = "'" . $value . "'";
        });
        // CSV format
        $columns = implode(',', $columns);

        return "[$columns]";
    }

    protected function addPropMassAssignment($fillable, $guarded)
    {
        $prop = '    /** Mass Assignment */';
        if (!$timestamps) {
            $prop .= "\n    protected \$fillable = [$fillable];"
        }

        if ($created_at) {
            $prop .= "\n    protected \$guarded = [$guarded];"
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