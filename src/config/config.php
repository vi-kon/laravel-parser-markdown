<?php

return [
    /*
     * Using extra rules which is not in official markdown syntax
     */
    'extra-rules' => true,
    /*
     * Rule settings
     */
    'rule'        => [
        /*
         * Math rule settings
         * Math plugin using http://www.sciweavers.org/free-online-latex-equation-editor online tool
         */
        'math' => [
            /*
             * Background color
             */
            'background' => 'White',
            /**
             * Font options
             */
            'font'       => [
                /*
                 * Font color
                 */
                'color' => 'Black',
                /*
                 * Font type
                 */
                'type'  => 'arev',
                /*
                 * Font options
                 */
                'size'  => 12,
            ],
            /*
             * Output image type (png, gif, jpg, ...)
             */
            'image'      => 'png',
        ],
    ],
];