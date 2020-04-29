module.exports = {
    theme: {
        container: {
            padding: '1.25rem',
            center: true,
        },
        extend: {
            fontFamily: {
                sans: [
                    'Titillium Web',
                    'Helvetica Neue',
                    'Helvetica',
                    'Arial',
                    'sans-serif',
                ],
                mono: ['Courier', 'monospace'],
            },
        },
        colors: {
            transparent: 'transparent',

            black: 'hsl(0, 0%, 0%)',
            white: 'hsl(0, 0%, 100%)',

            primary: {
                100: 'hsl(240, 100%, 95%)',
                200: 'hsl(240, 100%, 87%)',
                300: 'hsl(240, 100%, 80%)',
                400: 'hsl(240, 100%, 65%)',
                500: 'hsl(240, 100%, 50%)',
                600: 'hsl(240, 100%, 45%)',
                700: 'hsl(240, 100%, 30%)',
                800: 'hsl(240, 100%, 23%)',
                900: 'hsl(240, 100%, 15%)',
            },
            secondary: {
                100: 'hsl(48, 100%, 95%)',
                200: 'hsl(48, 100%, 87%)',
                300: 'hsl(48, 100%, 80%)',
                400: 'hsl(48, 100%, 65%)',
                500: 'hsl(48, 100%, 50%)',
                600: 'hsl(48, 100%, 45%)',
                700: 'hsl(48, 100%, 30%)',
                800: 'hsl(48, 100%, 23%)',
                900: 'hsl(48, 100%, 15%)',
            },
            danger: {
                100: 'hsl(0, 100%, 95%)',
                200: 'hsl(0, 100%, 87%)',
                300: 'hsl(0, 100%, 80%)',
                400: 'hsl(0, 100%, 65%)',
                500: 'hsl(0, 100%, 50%)',
                600: 'hsl(0, 100%, 45%)',
                700: 'hsl(0, 100%, 30%)',
                800: 'hsl(0, 100%, 23%)',
                900: 'hsl(0, 100%, 15%)',
            },
            gray: {
                100: 'hsl(216, 33%, 97%)',
                200: 'hsl(210, 26%, 93%)',
                300: 'hsl(210, 27%, 88%)',
                400: 'hsl(211, 28%, 79%)',
                500: 'hsl(211, 27%, 70%)',
                600: 'hsl(211, 20%, 63%)',
                700: 'hsl(211, 12%, 42%)',
                800: 'hsl(210, 11%, 32%)',
                900: 'hsl(210, 11%, 21%)',
            },
        },
        textStyles: theme => ({
            // defaults to {}
            heading: {
                output: false, // this means there won't be a "heading" component in the CSS, but it can be extended
                fontWeight: theme('fontWeight.bold'),
                lineHeight: theme('lineHeight.tight'),
            },
            h1: {
                extends: 'heading', // this means all the styles in "heading" will be copied here; "extends" can also be an array to extend multiple text styles
                fontSize: theme('fontSize.3xl'),
                '@screen md': {
                    fontSize: theme('fontSize.4xl'),
                },
                '@screen lg': {
                    fontSize: theme('fontSize.5xl'),
                },
            },
            h2: {
                extends: 'heading',
                fontSize: theme('fontSize.2xl'),
                '@screen md': {
                    fontSize: theme('fontSize.3xl'),
                },
                '@screen lg': {
                    fontSize: theme('fontSize.4xl'),
                },
            },
            h3: {
                extends: 'heading',
                fontSize: theme('fontSize.xl'),
                '@screen md': {
                    fontSize: theme('fontSize.2xl'),
                },
                '@screen lg': {
                    fontSize: theme('fontSize.3xl'),
                },
            },
            h4: {
                extends: 'heading',
                fontSize: theme('fontSize.lg'),
                '@screen md': {
                    fontSize: theme('fontSize.xl'),
                },
                '@screen lg': {
                    fontSize: theme('fontSize.2xl'),
                },
            },
            list: {
                output: false,
                marginTop: theme('spacing.5'),
                marginBottom: theme('spacing.5'),
                marginLeft: theme('spacing.10'),

                li: {
                    marginTop: theme('spacing.1'),
                },
            },
            link: {
                fontWeight: theme('fontWeight.semibold'),
                color: theme('colors.primary.500'),
                textDecoration: 'underline',

                '&:hover': {
                    textDecoration: 'none',
                },
            },
            richText: {
                lineHeight: theme('lineHeight.relaxed'),
                '> * + *': {
                    marginTop: theme('spacing.5'),
                },
                h1: {
                    extends: 'h1',
                },
                h2: {
                    extends: 'h2',
                },
                h3: {
                    extends: 'h3',
                },
                h4: {
                    extends: 'h4',
                },
                h5: {
                    extends: 'h5',
                },
                h6: {
                    extends: 'h6',
                },
                ul: {
                    extends: 'list',
                    listStyleType: 'disc',
                },
                ol: {
                    extends: 'list',
                    listStyleType: 'decimal',
                },
                a: {
                    extends: 'link',
                },
                'b, strong': {
                    fontWeight: theme('fontWeight.bold'),
                },
                'i, em': {
                    fontStyle: 'italic',
                },
            },
        }),
    },
    variants: {},
    plugins: [
        //
        require('@tailwindcss/custom-forms'),
        require('tailwindcss-typography')({
            componentPrefix: '', // the prefix to use for text style classes
        }),
    ],
};
