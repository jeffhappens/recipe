var gulp = require('gulp');
var sass = require('gulp-sass');
var prefixer = require('gulp-autoprefixer');



gulp.task('sass', function(){
	return gulp.src('resources/assets/sass/**/*.scss')
	.pipe(prefixer())
	.pipe(sass({ outputStyle: 'compressed' })) // Using gulp-sass
	.pipe(gulp.dest('public/css/'))
});

gulp.task('default', ['sass'] , function() {

    gulp.watch(['resources/assets/sass/app.scss'], ['sass']);

});




