# Buckii Larakit

A set of useful components for Laravel that can be shared across projects.

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
