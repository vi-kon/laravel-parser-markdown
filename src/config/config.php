<?php

return [
    /*
    | --------------------------------------------------------------------------
    | Extra rule
    | --------------------------------------------------------------------------
    | Allow extra rules which is not in official markdown syntax
    |
    | For example, the math rule
    |
    */
    'extra-rules' => true,
    /*
    | --------------------------------------------------------------------------
    | Individual rule settings
    | --------------------------------------------------------------------------
    |
    */
    'rule' => [
        /*
        | --------------------------------------------------------------------------
        | Math rule settings
        | --------------------------------------------------------------------------
        | Math plugin using for image generation
        | http://www.sciweavers.org/free-online-latex-equation-editor online tool
        |
        */
        'math' => [
            /*
            | --------------------------------------------------------------------------
            | Background color
            | --------------------------------------------------------------------------
            | Generated image background color.
            |
            | Available options: Transparent, White, Black, Blue, Cyan, Green, Magenta,
            |                    Red, Yellow, Orange, Maroon, NavyBlue, RoyalBlue,
            |                    ProcessBlue, SkyBlue, Turquoise, TealBlue, Aquamarine,
            |                    BlueGreen, Sepia, Brown, Tan, Gray, Fuchsia, Lavender,
            |                    Purple, Plum, Violet, GreenYellow, Goldenrod,
            |                    Dandelion, Apricot, Peach, Melon, YellowOrange,
            |                    BurntOrange, Bittersweet, RedOrange, Mahogany,
            |                    BrickRed, OrangeRed, RubineRed, WildStrawberry,
            |                    Salmon, CarnationPink, VioletRed, Rhodamine, Mulberry,
            |                    RedViolet, Thistle, Orchid, DarkOrchid, RoyalPurple,
            |                    BlueViolet, Periwinkle, CadetBlue, CornflowerBlue,
            |                    MidnightBlue, Cerulean, Emerald, JungleGreen, SeaGreen,
            |                    ForestGreen, PineGreen, LimeGreen, YellowGreen,
            |                    SpringGreen, OliveGreen, RawSienna
            |
            */
            'background' => 'White',
            /*
            | --------------------------------------------------------------------------
            | Font options
            | --------------------------------------------------------------------------
            |
            */
            'font' => [
                /*
                | --------------------------------------------------------------------------
                | Font color
                | --------------------------------------------------------------------------
                | Font color (foreground color) on generated image.
                |
                | Available options: White, Black, Blue, Cyan, Green, Magenta, Red, Yellow,
                |                    Orange, Maroon, NavyBlue, RoyalBlue, ProcessBlue,
                |                    SkyBlue, Turquoise, TealBlue, Aquamarine, BlueGreen,
                |                    Sepia, Brown, Tan, Gray, Fuchsia, Lavender, Purple,
                |                    Plum, Violet, GreenYellow, Goldenrod, Dandelion,
                |                    Apricot, Peach, Melon, YellowOrange, BurntOrange,
                |                    Bittersweet, RedOrange, Mahogany, BrickRed, OrangeRed,
                |                    RubineRed, WildStrawberry, Salmon, CarnationPink,
                |                    VioletRed, Rhodamine, Mulberry, RedViolet, Thistle,
                |                    Orchid, DarkOrchid, RoyalPurple, BlueViolet, Periwinkle,
                |                    CadetBlue, CornflowerBlue, MidnightBlue, Cerulean,
                |                    Emerald, JungleGreen, SeaGreen, ForestGreen, PineGreen,
                |                    LimeGreen, YellowGreen, SpringGreen, OliveGreen,
                |                    RawSienna
                |
                */
                'color' => 'Black',
                /*
                | --------------------------------------------------------------------------
                | Font type
                | --------------------------------------------------------------------------
                | Font type on generated image.
                |
                | Available options: modern, cmbright, ccfonts,eulervm, concmath, iwona,
                |                    anttor, pxfonts, mathpazo, mathpple, txfonts, mathptmx,
                |                    arev, mathdesign, fourier
                |
                */
                'type' => 'arev',
                /*
                | --------------------------------------------------------------------------
                | Font size
                | --------------------------------------------------------------------------
                | Font size on generated image.
                |
                */
                'size' => 12,
            ],
            /*
            | --------------------------------------------------------------------------
            | Image format
            | --------------------------------------------------------------------------
            | Generated image format.
            |
            | Available options: PNG, GIF, JPG, TIF, BMP, PBM, PGM, PPM, FIG, PS
            |
            */
            'image' => 'png',
        ],
    ],
];