var gulp = require('gulp');
var less = require('gulp-less');
var minifycss = require('gulp-minify-css');
var notify = require('gulp-notify');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var path = require('path');

gulp.task('less', function() {
    return gulp.src('src/less/main.less')
            .pipe(less({
                paths: [ path.join(__dirname, 'theme_components', 'bower', 'bootstrap', 'less') ]
            }))
            .pipe(minifycss())
            .pipe(gulp.dest('css'));
});

gulp.task('js', function() {
    return gulp.src(['src/js/**/*.js'])
            .pipe(concat('main.js'))
            .pipe(gulp.dest('js'));
});

gulp.task('watch', function() {
    gulp.watch('src/less/*.less', ['less']);
    
    gulp.watch('src/js/**/*.js', ['js']);
})

gulp.task('default', ['less', 'js', 'watch']);
