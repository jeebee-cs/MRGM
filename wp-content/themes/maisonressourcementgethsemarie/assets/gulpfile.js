"use strict";

// Dependencies instances
const { src, dest, parallel, series, watch } = require('gulp');

const gulp         = require('gulp'),
      autoprefixer = require('gulp-autoprefixer'),
      jshint       = require('gulp-jshint'),
      sass         = require('gulp-sass')(require('sass')),
      plumber      = require('gulp-plumber'),
      notify       = require('gulp-notify'),
      concat       = require('gulp-concat'),
      environments = require('gulp-environments'),
      mergestreams = require('merge-stream'),
      source       = require('vinyl-source-stream'),
      browserify   = require('browserify'),
      babelify     = require("babelify"),
      browsersync  = require("browser-sync"),
      local        = require('./local');

const pathSourcesBase     = '.',
      pathSrcSASS         = pathSourcesBase + '/_scss',
      pathSrcJS           = pathSourcesBase + '/_js',
      pathDestCSS         = pathSrcSASS + '/_compiled',
      pathDestJS          = pathSrcJS + '/_compiled';

// Stylesheet paths
const styleSheets = [
  {
    src: [
      `${pathSrcSASS}/theme.scss`,
    ],
    dest : pathDestCSS,
    name : 'theme.css'
  },
];

// Script paths
const scriptSheets = [
  {
    src: [
      `${pathSrcJS}/contenu/test.js`,
    ],
    dest : pathDestJS,
    name : 'theme.js'
  },
];

// Environment vars
const development = environments.development;
const production  = environments.production;

if (!environments.current()) { environments.current(production); }

const sassOptions = {
  includePaths   : ['./node_modules'],
  outputStyle    : 'expanded',
  sourceComments : 'line_comments',
  quietDeps : true,
};

const cssOptions = {
  restructure : true,
  sourceMap   : true,
  debug       : true
};

// Trigger OS error toast. (Windows + OSx)
let onError = function (err) {
  notify.onError({
    title    : 'Gulp',
    subtitle : 'Failure!',
    message  : 'Error: <%= error.message %>',
    sound    : 'Beep'
  })(err);

  this.emit('end');
};

// Styles
function styles() {
  const streams = styleSheets.map(function (file) {
    return src(file.src, { allowEmpty: true })
      .pipe(plumber({ errorHandler: onError }))
      .pipe(sass.sync(sassOptions).on('error', sass.logError))
      .pipe(concat(file.name))
      .pipe(autoprefixer({ cascade: false }))
      .pipe(gulp.dest(file.dest))
      .pipe(browsersync.stream());
  });
  return mergestreams(streams);
}

// Scripts
function scripts() {
  const streams = scriptSheets.map(function (file) {
    return browserify({
      entries   : file.src,
      debug     : development(),
      transform : [babelify.configure({ presets: ["@babel/preset-env"] })]
    })
      .bundle()
      .pipe(plumber({ errorHandler: onError }))
      .pipe(source(file.name))
      .pipe(gulp.dest(file.dest))
      .pipe(browsersync.stream());
  });
  return mergestreams(streams);
}

// Lint
function lint() {
  return src(`${pathSrcJS}/**/*.js`, { allowEmpty: true })
    .pipe(plumber({ errorHandler: onError }))
    .pipe(jshint({ esversion: 11 }))
    .pipe(jshint.reporter('jshint-stylish'))
}

// Browser sync
function syncBrowser() {
  browsersync.init({
    proxy: local.server
  })
}

// BrowserSync Reload
function browserSyncReload(done) {
  browsersync.reload();
  done();
}

// Watching files
function watchFiles() {
  watch([pathSrcSASS + '/**/*'], styles);
  watch([pathSrcJS + '/**/*'], parallel(lint, scripts));
  watch(["./../**/*.php"], browserSyncReload);
}

// Define complex tasks
const css   = gulp.series(styles);
const js    = gulp.series(lint, scripts);
const build = gulp.series(parallel(styles, scripts));

exports.js      = js;
exports.lint    = lint;
exports.css     = css;
exports.watch   = parallel(syncBrowser, watchFiles);
exports.default = build;