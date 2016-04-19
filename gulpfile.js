//  Main gulp JS
//  Copyright 2016 by inter-punkt.ag
//  Autor: Selim Imoberdorf
//  --------------------------------------------------------

'use strict';

//  dependencies
var gulp = require('gulp');

//  browsersync
var browserSync = require('browser-sync').create();

//  packages
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var less = require('gulp-less');

//  definition: for less files
var LessPluginCleanCSS = require('less-plugin-clean-css'),
    LessPluginAutoPrefix = require('less-plugin-autoprefix'),
    cleancss = new LessPluginCleanCSS({ advanced: true }),
    autoprefix = new LessPluginAutoPrefix({ browsers: ['> 2%', 'last 2 versions', 'Firefox ESR'] });


//  task: browsersync
gulp.task('serve', ['less'], function () {
  browserSync.init({
    proxy: '127.0.0.1:8000'
  });

  gulp.watch('web/assets/backend/_build/**/*.less', ['less']);
  gulp.watch('app/Resources/views/**/*.twig').on('change', browserSync.reload);
});

//  task: less
gulp.task('less', function () {
  gulp.src([
    'web/assets/backend/_build/less/AdminLTE.less',
    'web/assets/backend/_build/less/skins/skin-interpunkt.less'])
    .pipe(sourcemaps.init())
    .pipe(less({
      plugins: [autoprefix]
    }))
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest('web/assets/backend/_build/css'))
    .pipe(browserSync.stream());
});

//  build-task: styles
gulp.task('styles', function () {
  gulp.src([
    'web/assets/backend/_build/less/AdminLTE.less',
    'web/assets/backend/_build/less/skins/skin-interpunkt.less'])
    .pipe(less({
      plugins: [autoprefix, cleancss]
    }))
    .pipe(concat('main.css'))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest('web/assets/backend/css'));
});

//  build-task: scripts
gulp.task('scripts', function () {
  gulp.src(['web/assets/backend/_build/js/**/*.js'])
    .pipe(concat('app.js'))
    .pipe(uglify())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest('web/assets/backend/js'));
});

//  tasks: gulp
//  --------------------------------------------------------

//  task: default bind serve
gulp.task('default', ['serve']);

//  task: build
gulp.task('build', ['styles', 'scripts']);