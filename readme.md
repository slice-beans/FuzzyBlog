Sorry for the delay in getting this across, aside from setting up my task runners and migrating the database I didn't really get a chance to get stuck into the project until Friday evening!

# FuzzyBlog

Default username / password = admin / password

## Things I didn't do that I wish I had or aren't quite right

- Image processing (you'll see that post thumbnails are just left in their original dimensions, this makes me sad.)
- It was the first time I've used a task runner, and so my build process might not be optimal which I apologise for if this is the case. certainly I can see that there's no need for my components to be within the public directory
- encapsulated my controllers within the fuzzyblog namespace (they are not laravel core, and everything else is so why not those? Rush of blood to the head maybe.)
- My comments can be a little sparse when im working solo, I apologise if there is anything unclear
- Looking back through the code, I feel like it's a bit inconsistent that some controller actions respond through the model directly whereas others interact with the service layer -  I think it should be all of one type, however as I am aware of the time taking to submit I'm not fixing at this point
## Build process

blog contains a bower.json, package.json and gulpfile.js so that the development version can be built easily, for production version all js are uglified and concatenated into a single file and a less file is used to import all style library dependencies (bootstrap, font-awesome etc.) which is then minified and piped to a single file.

There is a .env. file that configures the database connection and app url etc, I've omitted it from the .gitignore in this case but this would normally not be added to the repo.

## Blog details

### Database

The database is very simple - I opted to use SQLite as it offers the greatest level of portablility, although if I were building this as a real application I would probably opt to use Postgres. The database could probably be normalized further by adding a morphable slug type as this is shared across more than one table. If I were to expand on the project further I would also introduce a role package such as Zizaco\Entrust which would add some tables to the database and greater flexibility for user roles. All migrations / seeds can be found in app/database/

The local.sqlite database file is already migrated and seeded if getting the blog up and running.

### Backend

Everything related to the blog (except for views and controllers) is encapsulated within app/FuzzyBlog.

I followed PSR-0 namespacing conventions for easy auto loading.

I used artisan's `controller:make` where possible so that my api is clean and consistent

To help achieve a full seperation of concerns I've expanded upon the typical MVC approach to include the following:

- Presenters, so that my Models don't contain presentation logic and my views are as logicless as possible (there are a fair few if statements but i've removed most of the deep logic)
- Services, (probably more aptly named modelhelpers) these are responsible for calling the model validators, they also contain domain-specific logic such as processing file uploads. They allow me to keep my controllers logicless

View composers, exceptions, service providers and validators are also self-contained.

I've used all of the typical OO-PHP features such as inheritance, interfaces and traits where applicable

### Frontend
There aren't many bells and whistles on the frontend, I've used twitter bootstrap as the basis of the site as I think it's awesome, and then expanded on that with my own less file found in /public/less/main.less

In terms of javascript I used wookmark, which is a masonry plugin and enabled me to easily give the category and archive views a pinterest type feel, I've also used bootbox for some dialogs in the admin panel, it's a great abstraction on normal bootstrap modals.

I also used DataTables for the admin resource lists, it's a great library for quickly adding dynamic sorting and filtering functionality to html tables



