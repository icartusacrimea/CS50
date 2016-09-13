/**
 * dictionary.c
 *
 * Traci Cremeans
 * Computer Science 50
 * Problem Set 5
 *
 * Implements a dictionary's functionality.
 */

#include <stdbool.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <ctype.h>

#include "dictionary.h"

node* root;
 
// Counter for number of words in dictionary
unsigned int words; 
 
// Prototype to allow recursion
void clear(node* ptr);

/**
 * Returns true if word is in dictionary else false.
 */
bool check(const char* word)
{
    int length = strlen(word);
 
    // Point to current node as program descends through trie
    node* ptr = root;
 
    for (int i=0; i < length; i++)
    {
        char c = tolower(word[i]);
 
        // Check if character is apostrophe
        if (c == '\'')
        {
            // 123 - 97 = 26; apostrophes located at nodes[26])
            c = 123;
        }
 
        // Get address of next node in trie
        struct node* nextNode = ptr->nodes[c-97];
 
        if (nextNode == NULL)
        {
            return false;
        }
        else
        {
            ptr = nextNode;
        }
    }
 
    // Check if entire word is in dictionary
    if (ptr->word == true)
    {
        return true;
    }
 
    return false;
}

/**
 * Loads dictionary into memory.  Returns true if successful else false.
 */
bool load(const char* dictionary)
{
    // Open dictionary file
    FILE* dict = fopen(dictionary, "r");
    if (dict == NULL)
    {
        return false;
    }
 
    // Allocate space for the first root node
    root = calloc(1, sizeof(node));
 
    // Point to current node as program descends through trie
    node* ptr = root;
 
    // Read dictionary one character at a time
    for (char c = tolower(fgetc(dict)); c != EOF; c = fgetc(dict))
    {
        // If word is finished
        if (c == '\n')
        {
            // Check that word is at least one letter long
            if (ptr != root)
            {
                words++;
 
                ptr->word = true;
 
                // Reset pointer back to top of trie
                ptr = root;                
            }
        }
        // If word is still in progress
        else
        {
            // Check if current character is apostrophe
            if (c == '\'')
            {
                // 123 - 97 = 26; apostrophes located at nodes[26]
                c = 123;
            }
 
            // Get address of next node in trie
            struct node* nextNode = ptr->nodes[c-97];
            if (nextNode == NULL)
            {
                // Allocate space if needed
                ptr->nodes[c-97] = calloc(1, sizeof(node));
 
                ptr = ptr->nodes[c-97];
            }
            else
            {
                ptr = nextNode;
            }
            
        }
    }
 
    fclose(dict);
 
    return true;
}

/**
 * Returns number of words in dictionary if loaded else 0 if not yet loaded.
 */
unsigned int size(void)
{
    return words;
}

/**
 * Unloads dictionary from memory.  Returns true if successful else false.
 */
bool unload(void)
{
    clear(root);
    return true;
}

/**
 * Recursive function that frees a trie from memory
 */
void clear(node* ptr)
{
    for (int i = 0; i < 27; i++)
    {
        if (ptr->nodes[i] != NULL)
        {
            clear(ptr->nodes[i]);
        }
    }
 
    free(ptr);
}
