# Buckii Larakit

A set of useful components for Laravel that can be shared across projects.

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

And then adding `"buckii/larakit": "dev-master"` to the `require` section.  Files
are PSR-4 loaded into the `\Buckii\Larakit` namespace.

Next you'll want to add `\Buckii\Larakit\LarakitProvider::class` to your app's
service providers in `config/app.php`.

There are no "stable" releases yet, so you'll have to track `dev-master`.
Might even make a [Satis](https://github.com/composer/satis) repo for it
eventually.

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

### Idempotent Database Seeder

Allows for idempotent database seeds.  See the class
documentation for usage and more details.

## TODOs

* Testing, this is a big one.
* Integrate Laravel Form Builder.
* Method to install each optional component individually.  Maybe register some
  artisan commands like `larakit:install --component=documents`.  This would
  then add the migrations for the user and maybe even drop in a Document model.
* Generic CRUD controller for simple models/scaffolding.
