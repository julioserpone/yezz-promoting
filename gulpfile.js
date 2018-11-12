//var elixir = require('laravel-elixir');
var gulp = require('gulp');
var sass = require('gulp-sass');
var cssnano = require('gulp-cssnano');
var gulpif = require('gulp-if');
var uglify = require('gulp-uglify');	//Not use for now (compress js)
var runSequence = require('run-sequence');

gulp.task('default', function(callback) {
  runSequence('build-css',
              'copy-fonts',
              callback);
});

//Build and compress CSS files
gulp.task('build-css', function() {
	return gulp.src([
		'resources/assets/sass/*.scss',
		'public/plugins/materialize/sass/materialize.scss',
		])
    .pipe(sass()) // Converts Sass to CSS with gulp-sass
    .pipe(gulpif('*.css', cssnano()))
    .pipe(gulp.dest('public/css'))
});

//Copy fonts
gulp.task('copy-fonts', function() {
	return gulp.src([
    'public/plugins/materialize/fonts/**/*',
    ])
	.pipe(gulp.dest('public/fonts'))
})

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

/*elixir(function(mix) {
    mix.sass('app.scss');
});*/


