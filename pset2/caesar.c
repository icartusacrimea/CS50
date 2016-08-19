#include <stdio.h>
#include <cs50.h>
#include <string.h>
#include <ctype.h>
#include <stdlib.h>


int main (int argc, string argv[])
{
    int i, k;
    
    //there must be 2 command line arguments
    
    if (argc <= 1 || argc > 2)
    {
        return 1;
    }
        
    string plaintext = GetString();
    
    //converts string to int
    
    int key = atoi(argv[1]);
    
    //ASCI works fine as long as key < 26
    
    if (key >= 26)
    {
        key = (key % 26);
    }
  
        for (i = 0, k = strlen(plaintext); i < k; i++)
        {
            int ciphertext = (plaintext[i] + key);
            
            if (isupper(plaintext[i]) && (ciphertext > 'Z'))
            {
                ciphertext = (ciphertext - 26);
            }
            if (islower(plaintext[i]) && (ciphertext > 'z'))
            {
                ciphertext = (ciphertext - 26);
            }
            
            if (isalpha(plaintext[i]))
            {
                printf("%c", ciphertext);
            }
            else
            {
                printf("%c", plaintext[i]);
            }
            
        }
  printf("\n");
  return 0;
}