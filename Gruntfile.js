/*!
 * Bootstrap's Gruntfile
 * http://getbootstrap.com
 * Copyright 2013-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */


module.exports = function (grunt) {

  'use strict';

  grunt.initConfig({
    watch: {
      // If any .less file changes in directory "build/less/" run the "less"-task.
      files: ["web/assets/backend/build/less/*.less", "web/assets/backend/build/less/skins/*.less", "web/assets/backend/build/js/*.js"],
      tasks: ["less", "uglify"]
    },
    // "less"-task configuration
    // This task will compile all less files upon saving to create both AdminLTE.css and AdminLTE.min.css
    less: {
      // Development not compressed
      development: {
        options: {
          // Whether to compress or not
          compress: false
        },
        files: {
          // compilation.css  :  source.less
          "web/assets/backend/dist/css/AdminLTE.css": "web/assets/backend/build/less/AdminLTE.less",
          //Non minified skin files
          "web/assets/backend/dist/css/skins/skin-interpunkt.css": "web/assets/backend/build/less/skins/skin-interpunkt.less"
        }
      },
      // Production compresses version
      production: {
        options: {
          // Whether to compress or not
          compress: true
        },
        files: {
          // compilation.css  :  source.less
          "web/assets/backend/dist/css/AdminLTE.min.css": "web/assets/backend/build/less/AdminLTE.less",
          // Skins minified
          "web/assets/backend/dist/css/skins/skin-interpunkt.min.css": "web/assets/backend/build/less/skins/skin-interpunkt.less"
        }
      }
    },
    // Uglify task info. Compress the js files.
    uglify: {
      options: {
        mangle: true,
        preserveComments: 'some'
      },
      my_target: {
        files: {
          'web/assets/backend/dist/js/app.min.js': ['web/assets/backend/build/js/app.js']
        }
      }
    },

    // Optimize images
    image: {
      dynamic: {
        files: [{
          expand: true,
          cwd: 'web/assets/backend/build/img/',
          src: ['**/*.{png,jpg,gif,svg,jpeg}'],
          dest: 'web/assets/backend/dist/img/'
        }]
      }
    },

    // Validate JS code
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      core: {
        src: 'web/assets/backend/build/js/app.js'
      }
    },

    csslint: {
      options: {
        csslintrc: 'web/assets/backend/build/less/.csslintrc'
      },
      dist: [
        'web/assets/backend/build/css/AdminLTE.css',
      ]
    },

    // Delete images in build directory
    // After compressing the images in the build/img dir, there is no need
    // for them
    clean: {
      build: ["web/assets/backend/build/img/*"]
    }
  });

  // Load all grunt tasks

  // LESS Compiler
  grunt.loadNpmTasks('grunt-contrib-less');
  // Watch File Changes
  grunt.loadNpmTasks('grunt-contrib-watch');
  // Compress JS Files
  grunt.loadNpmTasks('grunt-contrib-uglify');
  // Include Files Within HTML
  grunt.loadNpmTasks('grunt-includes');
  // Optimize images
  grunt.loadNpmTasks('grunt-image');
  // Validate JS code
  grunt.loadNpmTasks('grunt-contrib-jshint');
  // Delete not needed files
  grunt.loadNpmTasks('grunt-contrib-clean');
  // Lint CSS
  grunt.loadNpmTasks('grunt-contrib-csslint');

  // The default task (running "grunt" in console) is "watch"
  grunt.registerTask('default', ['watch']);
};
