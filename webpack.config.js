const path = require('path');
const webpack = require('webpack');
const AssetsPlugin = require('assets-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const ProgressBarPlugin = require('progress-bar-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  // Here the application starts executing and webpack starts bundling
  entry: {
    main: './resources/assets/js/main',
    vendor: './resources/assets/js/vendor',
    styles: './resources/assets/styles/styles'
  },

  // Options related to how webpack emits results
  output: {
    // The target directory for all output files must be an absolute path
    path: path.resolve(__dirname, 'public/dist'),
    // The filename template for entry chunks
    filename: 'js/[name].[hash].js',
  },

  optimization: {
    // Tell webpack to minimize the bundle using the UglifyjsWebpackPlugin.
    minimize: true,
    // npm packages are added to the vendor code separately in splitChunks below
    splitChunks: {
      cacheGroups: {
        common: {
          chunks: 'all',
          filename: 'js/[name].[hash].js',
          name: 'common',
          test: /[\\/]node_modules[\\/]/
        }
      }
    }
  },

  module: {
    rules: [
      {
        // Allows transpiling JavaScript files using Babel and webpack.
        test: /\.(js|jsx)$/,
        // include: path.resolve('./resources/assets'),
        // Exclude these folders from testing
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            "presets": [
              ["@babel/preset-env", {
                "targets": {
                  "browsers": ["last 3 versions"]
                }
              }],
              // Transforms JSX
              '@babel/preset-react',
            ]
          }
        }
      },

      {
        test: /\.s(a|c)ss$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader?reduceInitial=false',
          'resolve-url-loader',
          'sass-loader?sourceMap=true'
        ]
      },

      {
        test: /\.(eot|woff2?|ttf)$/,
        loader: 'file-loader',
        options: {
          name: '[name].[hash].[ext]',
          outputPath: 'fonts/',
        }
      },

      {
        test: /\.(png|gif|jpe?g|svg)$/,
        loader: 'file-loader',
        options: {
          name: '[name].[hash].[ext]',
          outputPath: 'images/',
        }
      },
    ]
  },

  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      jquery: 'jquery'
    }),

    new AssetsPlugin({
      filename: 'manifest.json',
      path: path.resolve('./public/dist'),
      publicPath: 'public/dist/',
      includeManifest: 'manifest',
      prettyPrint: true
    }),

    new CleanWebpackPlugin([
      'public/dist'
    ]),

    new MiniCssExtractPlugin({
      filename: 'css/[name].[chunkhash].css'
    }),

    // Makes it easier to see which dependencies are being patched
    new webpack.NamedModulesPlugin(),

    // Allows modules to be updated at runtime without the need for a full refresh
    new webpack.HotModuleReplacementPlugin()
  ],

  // Options for resolving module requests
  // (does not apply to resolving to loaders)
  resolve: {
    extensions: ['.js', '.json', '.jsx', '.css']
  },
}
