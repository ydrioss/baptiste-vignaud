var gulp = require('gulp');
var less = require('gulp-less');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync').create();
var autoprefixer = require('gulp-autoprefixer');

var path = './src/YD/PortfolioBundle';

gulp.task('less', function(){
  gulp.src(path + '/../CoreBundle/Resources/assets/less/bv.less')
  .pipe(sourcemaps.init())
  .pipe(less())
  .pipe(autoprefixer({ browsers: ['last 2 versions', 'IE 7'] }))
  .pipe(sourcemaps.write('./'))
  .pipe(gulp.dest('./web/css/'))
  .pipe(browserSync.stream());
});

gulp.task('watch', function() {
  gulp.watch(path + "/**/*.php").on('change', browserSync.reload);
  gulp.watch(path + "/**/**/**/*.html.twig").on('change', browserSync.reload);
  gulp.watch(path + "/../CoreBundle/**/**/**/*.html.twig").on('change', browserSync.reload);
  gulp.watch(path + '/../CoreBundle/Resources/assets/less/**/*.less', ['less']);
});

gulp.task('browser-sync', function(){
  browserSync.init({
    proxy: 'local.baptiste-vignaud.fr/web/app_dev.php'
  });
});

gulp.task('default', ['less', 'watch', 'browser-sync']);
