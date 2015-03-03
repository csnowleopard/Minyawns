module.exports = function( grunt ) {
  
  // Configuration goes here 
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    concat : {
            css :  {
                src : [
                        '<%= pkg.themedir %>/css/bootstrap.css',
                        '<%= pkg.themedir %>/css/bootstrap-responsive.css',
                        '<%= pkg.themedir %>/css/flat-ui.css',
                        '<%= pkg.themedir %>/css/main.css',
                        '<%= pkg.themedir %>/css/style.css',
                        '<%= pkg.themedir %>/css/font-awesome.css',
                        '<%= pkg.themedir %>/css/data_grids_main.css',
                        '<%= pkg.themedir %>/css/ajaxload.css',
                        '<%= pkg.themedir %>/css/bootstrap-tagmanager.css'
                      ],
                dest : '<%= pkg.themedir %>/css/minyawns-<%= pkg.env %>.css'
            }
    },

    cssmin: {
      minify: {
        expand: true,
        cwd: '<%= pkg.themedir %>/css/',
        src: ['*.css', '!*.min.css'],
        dest: '<%= pkg.themedir %>/css/',
        ext: '.min.css'
      }
    }

  });

  // Load plugins here
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-concat');

  // Define your tasks here
  grunt.registerTask('default', ['concat','cssmin']);
};