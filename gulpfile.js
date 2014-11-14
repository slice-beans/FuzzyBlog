var gulp = require('gulp'),
	less = require('gulp-less'),
	mini = require('gulp-minify-css'),
	name = require('gulp-rename'),
	conc = require('gulp-concat'),
	ugly = require('gulp-uglify');

gulp.task('less', function()
{
	return gulp.src('./public/less/main.less')
			.pipe(less({compress: true}))
			.pipe(mini({keepBreaks: false, processImport: true}))
			.pipe(name('main.min.css'))
			.pipe(gulp.dest('./public/css'));
});

gulp.task('concatjs', function()
{
	return gulp.src(['./public/components/jquery/jquery.min.js', './public/components/moment/min/moment.min.js', './public/components/Chart.js/Chart.min.js', './public/components/bootstrap/dist/js/bootstrap.min.js', './public/components/datatables/media/js/jquery.datatables.min.js', './public/components/datatables/media/js/bootstrap.datatables.js', './public/components/summernote/dist/summernote.min.js', './public/js/raw/admin.js'])
			.pipe(conc('main.min.js'))
			.pipe(ugly())
			.pipe(gulp.dest('./public/js'));
});

gulp.task('default', function()
{
	gulp.run('less');
	gulp.run('concatjs');

	gulp.watch('./public/less/*.less', function()
	{
		gulp.run('less');
	});

	gulp.watch('./public/js/raw/*.js', function()
	{
		gulp.run('concatjs');
	});
});

