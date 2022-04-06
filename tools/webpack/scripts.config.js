const path = require("path");

module.exports = env =>
{
    env = env || {};
    return {
        name: "scripts",
        entry: "./resources/js/src/index.js",
        output: {
            filename: "plentyshop-lts-modern.js",
            path: path.resolve(__dirname, "..", "..", "resources/js/dist/")
        },
        devtool: "source-map"
    };
};
