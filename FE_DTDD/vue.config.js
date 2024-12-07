const { defineConfig } = require('@vue/cli-service');

module.exports = defineConfig({
  devServer: {
    port: 8000, // Thay đổi cổng của Vue dev server thành 8000
  },
  transpileDependencies: true
});
