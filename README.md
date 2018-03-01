# WordBasedMarkov
Word-based PHP Markov chain text generator

This is a very simple word-based Markov chain text generator written in PHP. 

## Word-based 
### Why?
As I didn't find a word-based PHP Markov Chain text generator, I decided to fork a letter-based one to make it.
This is a fork of Hay Kranen's Markov chain text generator. Instead of working at the letters level, it works at the words level. See the original posting of the letter-based generator [here](http://www.haykranen.nl/projects/markov).

### What's the difference?
A letter-based Markov chain text generator generates words based on the probabilities of consecutive letters. Therefore, sometimes, and depending on the order, the generated words are completely made up. A word-based generator makes sure that only existing words of the text corpus are used, the generation works on the probabilities of consecutive words and not letters.

### Order
The order is then less relevant, especially for a small text corpus, as it will rely on probabilities of consecutive groups of words. Set the order at less than 4 if you still want something different than complete sentences of the original corpus.

## Example
The quiz [Who Wrote It: James Joyce or Markov Chains?](http://louphole.com/applications/who-wrote-it-james-joyce-or-markov-chains/) shows a typical use of such a program for text generation based on an existing corpus, in this case the last part of James Joyce's Ulysses.

## License
The source code of this generator is available under the terms of the [MIT license](http://www.opensource.org/licenses/mit-license.php).
