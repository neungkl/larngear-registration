var gulp = require('gulp');
var uglify = require('gulp-uglify');
var gulpif = require('gulp-if');
var plumber = require('gulp-plumber');
var babel = require('gulp-babel');
var minifyCss = require('gulp-clean-css');
var sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();

var production = false;

gulp.task('watch', function() {
  browserSync.init({
    ui : {
      port: 8000
    }
  });

  gulp.watch(['public/**/*', 'views/**/*'], ['sass', 'es6']);
  gulp.watch(['public/**/*', 'views/**/*']).on('change', browserSync.reload);
});

gulp.task('sass', function() {
	gulp.src('public/**/*.sass')
		.pipe(plumber())
		.pipe(sass().on('error', sass.logError))
		.pipe(gulpif(production, sourcemaps.init()))
		.pipe(gulpif(production, minifyCss()))
		.pipe(gulpif(production, sourcemaps.write('maps/')))
		.pipe(gulp.dest('public/'));
});

gulp.task('es6', function() {
	gulp.src('src/**/*.es6')
		.pipe(plumber())
		.pipe(babel({
			presets: ['es2015']
		}))
		.pipe(gulpif(production, sourcemaps.init()))
		.pipe(gulpif(production, uglify()))
		.pipe(gulpif(production, sourcemaps.write('maps/')))
		.pipe(gulp.dest('dist/'));
});

gulp.task('default', ['sass', 'es6']);
