// https://babeljs.io/docs/en/babel-preset-env
module.exports = {
  presets: [
    [
      '@babel/env',
      {}
    ]
  ],
  plugins: [
    '@wordpress/babel-plugin-import-jsx-pragma',
    '@babel/transform-react-jsx',
  ],
};
