// npm i gulp gulp-connect-php browser-sync --save-dev
let gulp = require('gulp');
let connect = require('gulp-connect-php');
let browserSync = require('browser-sync');
gulp.task('default', () => {
  connect.server({}, function() {
    browserSync({
      proxy: '127.0.0.1:8000'
    });
  });
  gulp.watch(['*.php']).on('change', function() {
    browserSync.reload();
  });
});
