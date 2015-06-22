/** Test program for NS final project
 The service provided by this code 
is to sent out 40 char when some one connected **/

#include<stdio.h>

int main()
{
	FILE* f = fopen("/home/flag/ssp", "r");
	char c;
	while((c=getc(f))!=EOF)
		putchar(c);
	fflush(stdout);
	return 0;
}
