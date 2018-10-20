[![Latest Stable Version](https://poser.pugx.org/hamed-sadeghinejad/article-manager/v/stable)](https://packagist.org/packages/hamed-sadeghinejad/article-manager)
[![Total Downloads](https://poser.pugx.org/hamed-sadeghinejad/article-manager/downloads)](https://packagist.org/packages/hamed-sadeghinejad/article-manager)
[![Latest Unstable Version](https://poser.pugx.org/hamed-sadeghinejad/article-manager/v/unstable)](https://packagist.org/packages/hamed-sadeghinejad/article-manager)
[![License](https://poser.pugx.org/hamed-sadeghinejad/article-manager/license)](https://packagist.org/packages/hamed-sadeghinejad/article-manager)
# Article manager
This package use [hsadeghinejad/AdminPanel](https://github.com/hsadeghinejad/AdminPanel) to create a article management and blog view for laravel projects

# Installation
1. Add this service provider (It's for laravels before 5.5):
```
HamedSadeghi\ArticleManager\ArticleManagerServiceProvider::class
```

2. Publish `AdminPanel` and `ArticleManager` assets:
```
php artisan vendor:publish --tag=AdminPanel-assets
php artisan vendor:publish --tag=ArticleManager-assets
```

3. Migrate `articles`, `categories` and `comments` tables:
```
php artisan migrate
```

# Using

## Blog
Insert this code in your blog view page:
```php
@include('articlemanager::blog')
```

## Categories
Insert this code for categories view
```php
@include('articlemanager::categories')
```

With this code access all of categories
```php
$categories = ArticleManager::categories();
```
And usnig `category.view` route to get link of articles of a category:
```php
<a href="{{ route('category.view', ['category' => $category->slug]) }}">$category->title</a>
