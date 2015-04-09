<?php
/*
    Word-based PHP Markov Chain text generator
	by WhiteFangs <https://github.com/WhiteFangs/WordBasedMarkov>
	Fork of the PHP Markov Chain text generator 1.0
    Copyright (c) 2008, Hay Kranen <http://www.haykranen.nl/projects/markov/>
    
    License (MIT / X11 license)    
    
    Permission is hereby granted, free of charge, to any person
    obtaining a copy of this software and associated documentation
    files (the "Software"), to deal in the Software without
    restriction, including without limitation the rights to use,
    copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the
    Software is furnished to do so, subject to the following
    conditions:
    
    The above copyright notice and this permission notice shall be
    included in all copies or substantial portions of the Software.
    
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
    EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
    OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
    NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
    HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
    WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
    FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
    OTHER DEALINGS IN THE SOFTWARE.
*/

require 'markov.php';

if (isset($_POST['submit'])) {
    // generate text with markov library
    $order  = $_REQUEST['order'];
    $length = $_REQUEST['length'];
    $input  = $_REQUEST['input'];
    $ptext  = $_REQUEST['text'];

    if ($input) $text = $input;
    if ($ptext) $text = file_get_contents("text/".$ptext.".txt");

    if(isset($text)) {
        $markov_table = generate_markov_table($text, $order);
        $markov = generate_markov_text($length, $markov_table, $order);

        if (get_magic_quotes_gpc()) $markov = stripslashes($markov);
    }
}
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>Word-based PHP Markov chain text generator by WhiteFangs</title>
</head>
<body>
    <h1>Word-based PHP Markov chain text generator</h1>
    <p>This is a very simple word-based Markov chain text generator. Try it below by entering some
    text or by selecting one of the pre-selected texts available. </p>
    <p>The source code of this generator is available under the terms of the <a href="http://www.opensource.org/licenses/mit-license.php">MIT license</a>. This is a fork of Hay Kranen's Markov chain text generator by WhiteFangs, you can find it on <a href="https://github.com/WhiteFangs/WordBasedMarkov">GitHub</a>. Instead of working at the letters level, it works at the words level. See the original posting of the letter-based generator <a href="http://www.haykranen.nl/projects/markov">here</a>.</p>

    <?php if (isset($markov)) : ?>
        <h2>Output text</h2>
        <textarea rows="20" cols="80" readonly="readonly"><?php echo $markov; ?></textarea>
    <?php endif; ?>

    <h2>Input text</h2>
    <form method="post" action="" name="markov">
        <textarea rows="20" cols="80" name="input"></textarea>
        <br />
        <select name="text">
            <option value="">Or select one of the input texts here below</option>
            <option value="alice">Alice's Adventures in Wonderland, by Lewis Carroll</option>
            <option value="calvin">The Wikipedia article on Calvin and Hobbes</option>
            <option value="kant">The Critique of Pure Reason by Immanuel Kant</option>
        </select>
        <br />
        <label for="order">Order</label>
        <input type="text" name="order" value="4" />
        <label for="length">Text size of output</label>
        <input type="text" name="length" value="2500" />
        <br />
        <input type="submit" name="submit" value="GO" />
    </form>

</body>
</html>