<?php
/**
 * Based in Laravel-5-Generators-Extended
 * https://github.com/laracasts/Laravel-5-Generators-Extended
 */
namespace SlimApp\Artisan;

use SlimApp\Artisan\GeneratorException;

class SyntaxBuilder
{
    /**
     * A template to be inserted.
     *
     * @var string
     */
    private $template;

    /**
     * Create the PHP syntax for the given schema.
     *
     * @param  array $schema
     * @param  string $action
     * @param  string $table
     * @return string
     * @throws GeneratorException
     */
    public function create($schema, $action, $table)
    {
        $up = $this->createSchemaForUpMethod($schema, $action);
        $down = $this->createSchemaForDownMethod($schema, $action, $table);

        return compact('up', 'down');
    }

    /**
     * Create the schema for the "up" method.
     *
     * @param  string $schema
     * @param  string $action
     * @return string
     * @throws GeneratorException
     */
    private function createSchemaForUpMethod($schema, $action)
    {
        $fields = $this->constructSchema($schema);

        if ($action == 'create') {
            return $this->insert($fields)->into($this->getCreateSchemaWrapper());
        }

        if ($action == 'add') {
            return $this->insert($fields)->into($this->getChangeSchemaWrapper());
        }

        if ($action == 'remove') {
            $fields = $this->constructSchema($schema, 'Drop');

            return $this->insert($fields)->into($this->getChangeSchemaWrapper());
        }

        // Otherwise, we have no idea how to proceed.
        throw new GeneratorException;
    }

    /**
     * Construct the syntax for a down field.
     *
     * @param  array $schema
     * @param  string $action
     * @param  string $table
     * @return string
     * @throws GeneratorException
     */
    private function createSchemaForDownMethod($schema, $action, $table)
    {
        // If the user created a table, then for the down
        // method, we should drop it.
        if ($action == 'create') {
            return sprintf("Capsule::schema()->dropIfExists('%s');", $table);
        }

        // If the user added columns to a table, then for
        // the down method, we should remove them.
        if ($action == 'add') {
            $fields = $this->constructSchema($schema, 'Drop');

            return $this->insert($fields)->into($this->getChangeSchemaWrapper());
        }

        // If the user removed columns from a table, then for
        // the down method, we should add them back on.
        if ($action == 'remove') {
            $fields = $this->constructSchema($schema);

            return $this->insert($fields)->into($this->getChangeSchemaWrapper());
        }

        // Otherwise, we have no idea how to proceed.
        throw new GeneratorException;
    }

    /**
     * Store the given template, to be inserted somewhere.
     *
     * @param  string $template
     * @return $this
     */
    private function insert($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get the stored template, and insert into the given wrapper.
     *
     * @param  string $wrapper
     * @param  string $placeholder
     * @return mixed
     */
    private function into($wrapper, $placeholder = 'DummySchemaUp')
    {
        return str_replace($placeholder, $this->template, $wrapper);
    }

    /**
     * Get the wrapper template for a "create" action.
     *
     * @return string
     */
    private function getCreateSchemaWrapper()
    {
        return file_get_contents(__DIR__ . '/stubs/migration.custom.create.stub');
    }

    /**
     * Get the wrapper template for an "add" action.
     *
     * @return string
     */
    private function getChangeSchemaWrapper()
    {
        return file_get_contents(__DIR__ . '/stubs/migration.custom.change.stub');
    }

    /**
     * Construct the schema fields.
     *
     * @param  array $schema
     * @param  string $direction
     * @return array
     */
    private function constructSchema($schema, $direction = 'Add')
    {
        if (!$schema) return '';

        $fields = array_map(function ($field) use ($direction) {
            $method = "{$direction}Column";

            return $this->$method($field);
        }, $schema);

        return implode(PHP_EOL . str_repeat(' ', 12), $fields);
    }


    /**
     * Construct the syntax to add a column.
     *
     * @param  string $field
     * @return string
     */
    private function addColumn($field)
    {
        if ($field['type'] === 'fx') {
            return sprintf("\$table->%s();", $field['name']);
        }

        if ($field['type'] === 'index') {
            $syntax = sprintf("\$table->%s()", $field['name']);
        } else if ($field['type'] === 'foreign') {
            $syntax = sprintf("\$table->foreign()");
        } else {
            $syntax = sprintf("\$table->%s('%s')", $field['type'], $field['name']);
        }


        // If there are arguments for the schema type, like decimal('amount', 5, 2)
        // then we have to remember to work those in.
        if ($field['arguments']) {
            $syntax = substr($syntax, 0, -1) . ', ';

            $syntax .= implode(', ', $field['arguments']) . ')';
        }

        foreach ($field['options'] as $method => $value) {
            $syntax .= sprintf("->%s(%s)", $method, $value === true ? '' : $value);
        }

        return $syntax .= ';';
    }

    /**
     * Construct the syntax to drop a column.
     *
     * @param  string $field
     * @return string
     */
    private function dropColumn($field)
    {
        return sprintf("\$table->dropColumn('%s');", $field['name']);
    }
}
