# dailyblogger
Webtech 2 Practical Assignment

Project by Akhil Kammalan Kandy-AK23204
           Satyam Vaishnav-SV2304

This project is a simple web-based blogging platform that allows users to create,edit,
and publish blog posts. It includes basic features for managing posts and displaying them to visitors.

Main Functionality
The system is a web-based blogging platform where:
    1. Users can:
        ◦ Create, edit, and delete blog posts (with text and images).
        ◦ Categorize posts using tags or categories.
        ◦ Comment on posts.
        ◦ Upload images to posts (JPEG/PNG, max 5MB).
    2. Admins can:
        ◦ Approve or delete posts.
        ◦ Manage users (block/unblock, assign roles).
        ◦ Edit/delete any post or comment.
    3. Visitors can:
        ◦ View public posts.
        ◦ Search posts by title, content, or tags.



MVC Structure
Models:
    • User, Post, Category, Tag, Comment, Image (for uploads).
Views:
    • Guest: Homepage (public posts), post details, search results.
    • User: Dashboard, post creation/editing, profile settings.
    • Admin: Approval dashboard, user management, analytics.
Controllers:
    • PostController: index, create, store, edit, update, destroy, search (filter by title/tags).
    • AdminController: approvePost, deletePost, manageUsers, toggleFeatured.
    • CommentController: store, delete.
    • Laravel Jetstream controllers for authentication and profile management.

