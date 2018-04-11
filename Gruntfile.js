module.exports = function (grunt) {

    require('load-grunt-tasks')(grunt); 
    grunt.initConfig({
        compass: {
            dist: {
              options: {
                watch: true
              }
            }
        },

        browserSync: {
            dev: {
                bsFiles: {
                    src : [
                        '*.php',
                        '*.html',
                        'css/*.css',
                        'img/*.png',
                        'img/*.jpg',
                        'js/*.js',
                        'js/**/*.js'
                    ]
                },
                options: {
                    proxy: '127.0.0.1/local.dev/mmi/epmn',
                    port: 8080,
                    watchTask: true,
                    notify: false
                }
            }
        },
        php: {
            dist: {
                options: {
                    hostname: 'localhost',
                    port: 80,
                    base: '127.0.0.1/local.dev/mmi/epmn', // Project root 
                    keepalive: false,
                    open: false
                }
            }
        },

    });

    grunt.registerTask('default', [
        'browserSync',
        'compass'
    ]);
}