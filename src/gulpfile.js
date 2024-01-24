const distPath = {
    admin: '../admin',
    public: '../public'
}

const srcPath = {
    admin: './admin',
    public: './public'
}

const path = {
    build: {
        css: '/assets/css/',
        js: '/assets/js/',
        img: '/assets/images/'
    },

    src: {
        css: '/scss/*.scss',
        js: '/js/*.js',
        img: '/images/**/*.{jpg,png,svg,gif,ico,webp}'
    },

    clean:  '/assets/',
}

const {
    src,
    dest,
    series,
    parallel
} = require('gulp')

const fileInclude = require('gulp-file-include')
const del = require('del')
const scss = require('gulp-sass')
const autoprefixer = require('gulp-autoprefixer')
const group_media = require('gulp-group-css-media-queries')
const clean_css = require('gulp-clean-css')
const rename = require('gulp-rename')
const uglify = require('gulp-uglify-es').default
const notify = require('gulp-notify')
const plumber = require('gulp-plumber')
const babel = require('gulp-babel')
const imageMin = require('gulp-imagemin')

function generateCssPublic() {
    const currentSrcPath = srcPath.public + path.src.css;
    const currentDistPath = distPath.public + path.build.css;

    return src(currentSrcPath)
        .pipe(
            plumber({
                errorHandler: function (err) {
                    notify.onError({
                        title: 'SCSS Error',
                        message: 'Error: <%= error.message %>',
                    })(err)
                    this.emit('end')
                },
            })
        )
        .pipe(scss({ outputStyle: 'expanded' }))
        .pipe(group_media())
        .pipe(
            autoprefixer({
                overrideBrowserslist: ['last 5 versions', 'ie >= 10'],
                cascade: true,
                grid: 'autoplace'
            })
        )
        .pipe(dest(currentDistPath))
        .pipe(clean_css())
        .pipe(rename({ extname: '.min.css' }))
        .pipe(dest(currentDistPath))
}
function generateCssAdmin() {
    const currentSrcPath = srcPath.admin + path.src.css;
    const currentDistPath = distPath.admin + path.build.css;

    return src(currentSrcPath)
        .pipe(
            plumber({
                errorHandler: function (err) {
                    notify.onError({
                        title: 'SCSS Error',
                        message: 'Error: <%= error.message %>',
                    })(err)
                    this.emit('end')
                },
            })
        )
        .pipe(scss({ outputStyle: 'expanded' }))
        .pipe(group_media())
        .pipe(
            autoprefixer({
                overrideBrowserslist: ['last 5 versions', 'ie >= 10'],
                cascade: true,
                grid: 'autoplace'
            })
        )
        .pipe(dest(currentDistPath))
        .pipe(clean_css())
        .pipe(rename({ extname: '.min.css' }))
        .pipe(dest(currentDistPath))
}

function generateJsPublic() {
    const currentSrcPath = srcPath.public + path.src.js;
    const currentDistPath = distPath.public + path.build.js;

    return src(currentSrcPath)
        .pipe(
            plumber({
                errorHandler: function (err) {
                    notify.onError({
                        title: 'JS Error',
                        message: 'Error: <%= error.message %>',
                    })(err)
                    this.emit('end')
                },
            })
        )
        .pipe(fileInclude())
        .pipe(plumber())
        .pipe(
            babel({
                presets: ['@babel/env'],
            })
        )
        .pipe(dest(currentDistPath))
        .pipe(uglify())
        .pipe(rename({ extname: '.min.js' }))
        .pipe(dest(currentDistPath))
}
function generateJsAdmin() {
    const currentSrcPath = srcPath.admin + path.src.js;
    const currentDistPath = distPath.admin + path.build.js;

    return src(currentSrcPath)
        .pipe(
            plumber({
                errorHandler: function (err) {
                    notify.onError({
                        title: 'JS Error',
                        message: 'Error: <%= error.message %>',
                    })(err)
                    this.emit('end')
                },
            })
        )
        .pipe(fileInclude())
        .pipe(plumber())
        .pipe(
            babel({
                presets: ['@babel/env'],
            })
        )
        .pipe(dest(currentDistPath))
        .pipe(uglify())
        .pipe(rename({ extname: '.min.js' }))
        .pipe(dest(currentDistPath))
}
function optimisePublicImages() {
    const currentSrcPath = srcPath.public + path.src.img;
    const currentDistPath = distPath.public + path.build.img;

    return src(currentSrcPath)
        .pipe(
            imageMin([
                imageMin.gifsicle(
                    { interlaced: true }
                ),
                imageMin.mozjpeg(
                    { quality: 100, progressive: true }
                ),
                imageMin.optipng(
                    { optimizationLevel: 3 }
                ),
                imageMin.svgo({
                    plugins: [
                        { removeViewBox: true }, { cleanupIDs: false }
                    ],
                }),
            ])
        )
        .pipe(dest(currentDistPath))
}
function optimiseAdminImages() {
    const currentSrcPath = srcPath.admin + path.src.img;
    const currentDistPath = distPath.admin + path.build.img;

    return src(currentSrcPath)
        .pipe(
            imageMin([
                imageMin.gifsicle(
                    { interlaced: true }
                ),
                imageMin.mozjpeg(
                    { quality: 100, progressive: true }
                ),
                imageMin.optipng(
                    { optimizationLevel: 3 }
                ),
                imageMin.svgo({
                    plugins: [
                        { removeViewBox: true }, { cleanupIDs: false }
                    ],
                }),
            ])
        )
        .pipe(dest(currentDistPath))
}

function cleanPubic() {
    return del(distPath.public + path.clean,{force: true})
}
function cleanAdmin() {
    return del(distPath.admin + path.clean, {force: true})
}

let build = series(
    parallel(
        cleanAdmin,
        cleanPubic,
    ),
    parallel(
        generateJsAdmin,
        generateJsPublic,
        generateCssAdmin,
        generateCssPublic,
        optimiseAdminImages,
        optimisePublicImages
    )
)

exports.default = build
exports.build = build