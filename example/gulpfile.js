// npm i gulp gulp-connect-php browser-sync --save-dev
var gulp = require('gulp');
var connect = require('gulp-connect-php');
var browserSync = require('browser-sync');
gulp.task('default', function() {
  connect.server({}, function() {
    browserSync({
      proxy: '127.0.0.1:8000'
    });
  });
  gulp.watch('**/*.php').on('change', function() {
    browserSync.reload();
  });
});
