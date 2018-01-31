<?php

// Create Account
Breadcrumbs::register('alumni', function ($breadcrumbs) {
    $breadcrumbs->push('Create Account', route('users.alumni.create'));
});

// Create Account > Add Milestones
Breadcrumbs::register('milestones', function ($breadcrumbs) {
    $breadcrumbs->parent('alumni');
    $breadcrumbs->push('Add Milestones', route('about'));
});

// Home > Blog
Breadcrumbs::register('blog', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::register('category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('blog');
    $breadcrumbs->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::register('post', function ($breadcrumbs, $post) {
    $breadcrumbs->parent('category', $post->category);
    $breadcrumbs->push($post->title, route('post', $post));
});