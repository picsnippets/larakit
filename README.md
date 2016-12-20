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

There are no "stable" releases yet, so you'll have to track `dev-master`.
Might even make a [Satis](https://github.com/composer/satis) repo for it
eventually.

## Components

### Documents

A generalized way of storing files related to database
objects. You will need to create a table, `documents`, and
can use `migrations/create_documents_table.php` as a guide.
Then simply add a model to your app that extends the
`Buckii\Larakit\Models\Document` class.

### Idempotent Database Seeder

Allows for idempotent database seeds.  See the class
documentation for usage and more details.
