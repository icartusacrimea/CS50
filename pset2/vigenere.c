#include <stdio.h>
#include <cs50.h>
#include <string.h>
#include <ctype.h>
#include <stdlib.h>


int main (int argc, string argv[])
{
    
    //there must be 2 command line arguments
    if (argc <= 1 || argc > 2)
    {
        printf("One argument is needed (a key in alphabetical chars)!");
        return 1;
    }
    

    for (int i = 0, n = strlen(argv[1]); i < n; i++)
    {
        if (!isalpha(argv[1][i]))
        {
                printf("Key must be alphabetic chars only.");

                return 1;
        }
    }

    string keyword = argv[1];
    int keywordLen = strlen(keyword);

    string plaintext = GetString();
    
  
    int i, k, j;

        for (i = 0, j = 0, k = strlen(plaintext); i < k; i++)
        {
            int letterKey = tolower(keyword[j % keywordLen]) - 'a';

            
            if (isupper(plaintext[i]))
            {
                printf("%c", 'A' + (plaintext[i] - 'A' + letterKey) % 26);
                j++;
            }
            else if (islower(plaintext[i]))
            {
                printf("%c", 'a' + (plaintext[i] - 'a' + letterKey) % 26);
                j++;
            }
            else
            {
                printf("%c", plaintext[i]);
            }
                
        }
    
    printf("\n");
    return 0;
}