/* jshint: node: true */
var gulp = require('gulp');
var notify = require('gulp-notify');
var shell = require('gulp-shell');
var project = require('path').posix.basename(__dirname);

gulp.task('default', ['watch']);
gulp.task('php_check', function () {
    gulp.src('')
        .pipe(shell('composer check'))
        .on('error', notify.onError({
            title: project + ' failures',
            message: project + ' CS checks and/or tests failed'
        }));
});
gulp.task('watch', function () {
    gulp.watch(
        ['phpunit.xml', 'phpmd.xml', 'phpcs.xml', 'src/**/*.php', 'tests/**/*.php'],
        ['php_check']
    );
});