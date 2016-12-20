<?php

namespace Buckii\Larakit\Database;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use DB;

abstract class IdempotentDatabaseSeeder extends Seeder
{

    protected $added;
    protected $updated;
    protected $error;

    public function __construct()
    {
        $this->added = new Collection();
        $this->updated = new Collection();
        $this->error = new Collection();
    }

    /**
     * Get an empty instance of the Model being seeded.
     *
     * @return Model The type of Model being seeded
     */
    abstract public function getModel();

    /**
     * Get the data to insert into the table
     *
     * @return Collection The data to insert
     */
    abstract public function getData();

    /**
     * Determine if the given model already exists in the database.
     *
     * The default implementation checks for an id field, then a slug field,
     * then a name field, returning true if it finds an object in the DB which
     * matches any of these.
     *
     * @param Model $model
     *
     * @return mixed The Model if it exists, null otherwise
     */
    public function modelExists(Model $model)
    {
        foreach (['id', 'slug', 'name'] as $key) {
            $attr = $model->getAttribute($key);

            if (!is_null($attr)) {
                return $model->where($key, $attr)->first();
            }
        }

        return false;
    }

    /**
     * For PostgreSQL, fixes the id sequence after insertions are complete.
     *
     */
    public function fixSequence()
    {
        $table_name = $this->getModel()->getTable();
        $max_id = DB::table($table_name)->max('id');
        ++$max_id;

        DB::statement(sprintf(
            'ALTER SEQUENCE %s_id_seq RESTART %d',
            $table_name,
            $max_id
        ));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $data = $this->getData();

        foreach ($data as $attrs) {
            $model = $this->getModel();
            $model->fill($attrs);

            $existing = $this->modelExists($model);
            if ($existing) {
                $existing->fill($attrs);
                $existing->save();
                $this->updated->push($existing);
            } elseif ($model->save()) {
                $this->added->push($model);
            } else {
                $this->error->push($model);
            }
        }

        $this->fixSequence();
        Model::reguard();

        $this->command->info(
            sprintf(
                '%s complete: %d added; %d updated; %d errors',
                static::class,
                $this->added->count(),
                $this->updated->count(),
                $this->error->count()
            )
        );
    }
}
