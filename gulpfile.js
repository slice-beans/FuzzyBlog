var gulp = require('gulp'),
	less = require('gulp-less'),
	path = require('path'),
	mini = require('gulp-minify-css'),
	name = require('gulp-rename');

gulp.task('less', function()
{
	return gulp.src('./public/less/main.less')
			.pipe(less({compress: true}))
			.pipe(mini({keepBreaks: false, processImport: true}))
			.pipe(name('main.min.css'))
			.pipe(gulp.dest('./public/css'));
});

gulp.task('default', function()
{
	gulp.run('less');

	gulp.watch('./public/less/**/*.less', function()
	{
		gulp.run('less');
	});
});

