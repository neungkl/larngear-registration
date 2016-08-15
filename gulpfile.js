var gulp = require('gulp');
var uglify = require('gulp-uglify');
var gulpif = require('gulp-if');
var plumber = require('gulp-plumber');
var babel = require('gulp-babel');
var minifyCss = require('gulp-clean-css');
var sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();
var env = require('node-env-file');

env(__dirname + '/.env');

var production = (process.env.MODE != "DEVELOPMENT");

gulp.task('watch', function() {
  browserSync.init({
    ui : {
      port: 8000
    }
  });

  gulp.start(['sass', 'es6']);

  gulp.watch(['private/**/*.scss', 'private/**/*.es6'], ['sass', 'es6']);
  gulp.watch(['private/**/*']).on('change', browserSync.reload);
});

gulp.task('sass', function() {
	gulp.src('private/**/*.scss')
		.pipe(plumber())
		.pipe(sass().on('error', sass.logError))
		.pipe(gulpif(production, sourcemaps.init()))
		.pipe(gulpif(production, minifyCss()))
		.pipe(gulpif(production, sourcemaps.write('maps/')))
		.pipe(gulp.dest('public/src/'));
});

gulp.task('es6', function() {
	gulp.src('private/**/*.es6')
		.pipe(plumber())
		.pipe(babel())
		.pipe(gulpif(production, sourcemaps.init()))
		.pipe(gulpif(production, uglify()))
		.pipe(gulpif(production, sourcemaps.write('maps/')))
		.pipe(gulp.dest('public/src/'));
});

gulp.task('default', ['sass', 'es6']);
