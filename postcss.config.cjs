/**
 * postcss.config.js
 *
 * @author Philippe Gaultier <pgaultier@blackcube.io>
 * @copyright 2010-2025 Blackcube
 */

module.exports = () => {
    return {
        plugins: {
            "@tailwindcss/postcss": {},
            // cssnano: {
            //     preset: require('cssnano-preset-advanced')
            // }
        }
    };
};

