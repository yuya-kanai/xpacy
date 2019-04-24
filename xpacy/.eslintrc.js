module.exports = exports = {
  "root": true,
  "env": {
    "node": true,
  },
  "parserOptions": {
    "parser": "babel-eslint",
    "ecmaVersion": 2017,
    "sourceType": "module"
  },
  "extends": [
    "eslint:recommended",
    "plugin:vue/recommended",
    "prettier",
    "prettier/vue",
  ],
  "rules": {
    'no-console': 'warn',
    "quotes": [2, "single", { "avoidEscape": true }]
  }
}
