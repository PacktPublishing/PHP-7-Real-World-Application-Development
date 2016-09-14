module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
	        css: {
	           src: [
	                 'css/*'
	                ],
	            dest: 'dist/combined.css'
	        },
	        js : {
	            src : [
	                'js/*'
	            ],
	            dest : 'dist/combined.js'
	        }
    	},
    	cssmin: {
	    		css:{
	                src: 'dist/combined.css',
	                dest: 'dist/combined.min.css'
	            }
    	},
    	uglify: {
    		js: {
    			files: {
    				/* Destination Path*/			  /*Src Path*/ 	
    				'dist/combined.min.js' : [ 'dist/combined.js' ]
    			}
    		}
    	}
    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.registerTask('default', [ 'concat:css', 'cssmin:css', 'concat:js', 'uglify:js' ]);
};