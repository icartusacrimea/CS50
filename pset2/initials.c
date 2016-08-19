#include <stdio.h>
#include <cs50.h>
#include <string.h>
#include <ctype.h>


int main (void)
{
    string user_name = GetString();
    
    int i, k;
        
        if (isalpha(user_name[0]))
        {
        printf("%c", toupper(user_name[0]));
        }
        
        for (i = 1, k = strlen(user_name); i < k; i++)
        {
            if (user_name[i] == ' ')
            {
                if (isalpha(user_name[i + 1]))
                {
                printf("%c", toupper(user_name[i + 1]));
                }
            }
        }
        printf("\n");
}