//  Main gulp JS
//  Copyright 2016 by inter-punkt.ag
//  Autor: Selim Imoberdorf
//  --------------------------------------------------------

'use strict';

//  dependencies
var gulp = require('gulp');

//  packages
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var nano = require('gulp-cssnano');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');

//  browsersync
var browserSync = require('browser-sync').create();

//  task: browsersync
gulp.task('serve', ['sassAdmin'], function () {
    browserSync.init({
        proxy: '127.0.0.1:8000'
    });

    gulp.watch('/web/assets/**/*.scss', ['sass']);
    gulp.watch('/app/Resources/**/*.twig').on('change', browserSync.reload);
});

//  task: sass admin
gulp.task('sassAdmin', function () {
    gulp.src('/web/admin/scss/adminApp.scss')
        .pipe(sourcemaps.init())
        .pipe(sass.sync({
            outputStyle: 'expanded', precision: 10, includePaths: ['.']
        }).on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['> 2%', 'last 2 versions', 'Firefox ESR']
        }))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('/web/admin/css'))
        .pipe(browserSync.stream());
});

//  task: sass frontend
gulp.task('sassAdmin', function () {
    gulp.src('/web/frontend/scss/frontendApp.scss')
        .pipe(sourcemaps.init())
        .pipe(sass.sync({
            outputStyle: 'expanded', precision: 10, includePaths: ['.']
        }).on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['> 2%', 'last 2 versions', 'Firefox ESR']
        }))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('/web/frontend/css'))
        .pipe(browserSync.stream());
});

//  build-task: frontend styles
gulp.task('styles', function () {
    gulp.src('/web/frontend/scss/frontendApp.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('frontendApp.css'))
        .pipe(autoprefixer({
            browsers: ['> 2%', 'last 2 versions', 'Firefox ESR']
        }))
        .pipe(nano({
            discardComments: {
                removeAll: true
            }
        }))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('/web/assets/compiled'));
});

//  build-task: frontend fallback
gulp.task('fallback', function () {
    gulp.src('/web/frontend/scss/frontendFallback.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('frontendFallback.css'))
        .pipe(autoprefixer({
            browsers: ['> 2%', 'last 2 versions', 'Firefox ESR']
        }))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('/web/assets/compiled'));
});

//  build-task: frontend js
gulp.task('js', function () {
    gulp.src(['/web/frontend/js/main.js'])
        .pipe(concat('frontendApp.js'))
        .pipe(uglify())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('/web/assets/compiled'));
});

//  tasks: gulp
//  --------------------------------------------------------

//  task: default bind serve
gulp.task('default', ['serve']);

//  task: build
gulp.task('build', ['styles', 'fallback', 'js']);