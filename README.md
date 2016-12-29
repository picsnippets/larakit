# Buckii Larakit

A set of useful components for Laravel that can be shared across projects.

Currently requires the use of PostgreSQL for several of the components.  Will
probably add MySQL support and maybe others in the future.

## Install

You can add this to a project by using a custom repository in your `composer.json`:

```
"repositories": [
	{
		"type": "vcs",
		"url": "https://projects.buckii.com/source/buckii-larakit.git"
	}
]
```

And then adding `"buckii/larakit": "dev-master"` to the `require` section.	Files
are PSR-4 loaded into the `\Buckii\Larakit` namespace.

Next you'll want to add `\Buckii\Larakit\LarakitProvider::class` to your app's
service providers in `config/app.php`.

There are no "stable" releases yet, so you'll have to track `dev-master`.
Might even make a [Satis](https://github.com/composer/satis) repo for it
eventually.

## Testing

There is some limited automated testing included.  Several of the tests require
a PostgreSQL database in order to run.	A composer command to start and stop a
configured docker container is included, make sure you have docker installed in
order to use it.  The process for running tests looks like this:

```
composer install
composer start-db
composer test
composer stop-db
```

More comprehensive automated testing of the various components is in progress.

## Components

### Address

Simple model for storing and interacting with US addresses.  Probably will
expand to international addresses eventually.  You will need to create a
migration (use `migration/create_addresses_table.php` as a template) and add a
Model to your app that extends the `Buckii\Larakit\Models\Address` class.

### Document

A generalized way of storing files related to database
objects. You will need to create a table, `documents`, and
can use `migrations/create_documents_table.php` as a guide.
Then simply add a model to your app that extends the
`Buckii\Larakit\Models\Document` class.

### Error

Simple way to add error reporting to the database.	Create an `errors` table
using the migration provided as a base, then make sure your
`Exceptions\Handler` class extends `Buckii\Larakit\Exceptions\Handler` instead
of the default.

### Idempotent Database Seeder

Allows for idempotent database seeds.  See the class
documentation for usage and more details.

## TODOs

* Testing, this is a big one. (In progress)
* Integrate Laravel Form Builder.
	* Partially complete, need to add additional custom field types.
* Method to install each optional component individually.
	* Maybe register some artisan commands like `larakit:install --component=documents`.
* Generic CRUD controller for simple models/scaffolding.
	* This will probably end up being a collection of components such as `StoreResourceRequest` and `UpdateResourceRequest`.
* Front end integration
	* Probably based on an additional NPM dependency.
