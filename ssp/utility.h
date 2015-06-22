#ifndef STDIO_H
#define STDIO_H
#include<stdio.h>
#endif

#ifndef STRING_H
#define STRING_H
#include<string.h>
#endif

#ifndef TIME_H_
#define TIME_H_
#include<time.h>
#endif

#ifndef STDLIB_H_
#define STDLIB_H_
#include<stdlib.h>
#endif

#ifndef LIMITS_H_
#define LIMITS_H_
#include<limits.h>
#endif

#ifndef OPNENSSL_MD5_H_
#define OPENSSSL_MD5_H_
#include<openssl/md5.h>
#endif

#ifndef UTILITY_H_
#define UTILITY_H_

struct pinfocard
{
    char buff[24];
    struct pinfocard* next; 
};

extern struct pinfocard* pf;
extern char username[24];
extern char password[64];
extern unsigned int auth;
extern int real_money;
extern int virtual_money;

void hellomsg();
int menu();
void login();
void changemoney(char [], unsigned int, unsigned int);
void leavemsg();
void displaynmodifyinfo();
void initial_pinfo();
void changeback();
int betting();
void Million();
#endif
