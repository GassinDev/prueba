var Encore = require('@symfony/webpack-encore');

Encore
    .enableReactPreset()
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/app.jsx')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableSingleRuntimeChunk()
;

module.exports = Encore.getWebpackConfig();