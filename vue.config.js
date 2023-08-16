const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
    transpileDependencies: true,
    filenameHashing: false,
    css: {
        sourceMap: true,
    },
    chainWebpack: (config) => {
        config.plugin("html").tap((args) => {
            args[0].template = "public/index.ejs"; // 指定新的模板文件路径
            args[0].title = `日日旅著 | Daily.TW`;
            return args;
        });
    },
})
