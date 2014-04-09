var gulp = require('gulp');
var less = require('gulp-less');
var minifycss = require('gulp-minify-css');
var notify = require('gulp-notify');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var path = require('path');

gulp.task('less', function() {
    return gulp.src('frontend_src/less/main.less')
            .pipe(less({
                paths: [ path.join(__dirname, 'frontend_src', 'bower_components', 'bootstrap', 'less') ]
            }))
            .pipe(minifycss())
            .pipe(gulp.dest('public/admin_assets/css'))
            .pipe(notify({"message": "LESS compiled!"}));
});

gulp.task('frontend', function() {
    return gulp.src('frontend_src/less/frontend.less')
            .pipe(less({
                paths: [ path.join(__dirname, 'frontend_src', 'bower_components', 'bootstrap', 'less') ]
            }))
            .pipe(minifycss())
            .pipe(gulp.dest('public/admin_assets/css'))
            .pipe(notify({"message": "Frontend compiled!"}));
});

var third_party = [
    'frontend_src/bower_components/jquery/dist/jquery.min.js',
    'frontend_src/bower_components/angular/angular.min.js',
    'frontend_src/bower_components/angular-route/angular-route.min.js',
    'frontend_src/bower_components/angular-animate/angular-animate.min.js',
    'frontend_src/bower_components/angular-sanitize/angular-sanitize.min.js',
    'frontend_src/bower_components/angular-bootstrap/ui-bootstrap.min.js',
    'frontend_src/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js',
    'frontend_src/bower_components/ng-flow/dist/ng-flow-standalone.min.js',
    'frontend_src/bower_components/angular-dialog-service/dialogs.min.js',
    'frontend_src/bower_components/angular-dragdrop-ganarajpr/draganddrop.js',
    'frontend_src/bower_components/angular-ui-tinymce/src/tinymce.js'
]

gulp.task('js', function() {
    return gulp.src(third_party.concat(['frontend_src/js/**/*.js']))
            .pipe(concat('admin.js'))
            .pipe(gulp.dest('public/admin_assets/js'))
            .pipe(notify({"message": "JavaScript compiled!"}));
});

gulp.task('frontjs', function() {
    return gulp.src('frontend_src/frontend/frontend.js')
            .pipe(gulp.dest('public/admin_assets/js'))
            .pipe(notify({"message": "Frontend JS compiled!"}));
});

gulp.task('default', ['less', 'js', 'frontend', 'frontjs'], function() {

    gulp.watch('frontend_src/less/*.less', function() {
        gulp.run('less');
    });

    gulp.watch('frontend_src/less/frontend.less', function() {
        gulp.run('frontend');
    });

    gulp.watch('frontend_src/js/**/*.js', function() {
        gulp.run('js');
    });

    gulp.watch('frontend_src/frontend/**/*.js', function() {
        gulp.run('frontjs');
    });
});