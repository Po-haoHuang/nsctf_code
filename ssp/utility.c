//This is the source code of of SSP
//You can modify it and compile with $make
//Any problems please info me w.zongyu@gmail.com

#include "utility.h"
#define ADMIN_PASSWORD "284ru8 cl3ji3g4jj"
// TODO change password 
//"admin" is the default password of debugmode
//Never let anyone know the ADMIN_PASSWORD
//You should modify it to your know password
#define FLAGPATH "/home/flag/ssp"
struct pinfocard* pf;//Linked-list for holding username and some message
char username[24]="";
char password[64]="";
unsigned int auth=0;//Authentication bit for service, 0 is simple user, >0 from admin
int real_money=10000;//Initial real money, clinet can change to virtual money
int virtual_money=0;//Initial virtual money for client to play the game

void hellomsg()
{
    //Just a simple hello message
    printf("\n==============================================================\n"); 
    printf("| Hello!! Welcome to Super Secure Program (SSP) Gaming system!|\n");
    printf("| Since the last game was badly broken by you hackers!        |\n");
    printf("| We will introduce a brand new system which is very secure   |\n");
    printf("==============================================================\n\n");
    fflush(stdout);
    return;
}

int menu()
{
    //menu for incoming client
    while(1)
    {
        int choice=-1;
        printf("\n1. Change money to virtual money        \n");
        printf("2. Change virtual money back              \n");
        printf("3. Display and Modify Personal Infromation\n");
        printf("4. Gambling                               \n");
        printf("5. Million Dollars Primary Schoool        \n");
        printf("6. Leave some message                     \n");
        printf("7. [Admin-only]Debuging menu              \n");
        printf("8. Leave                                  \n");
        if(auth)    //admin
            printf("#");
        else    //user
            printf("$");
        fflush(stdout);
        scanf("%d", &choice);
        getchar();
        if(choice<=8&&choice>=1)//simple check
            return choice;
    }
    return;
}

void login()
{
    //Function for handling login
    //Service check will login as admin with your own flag
    //So your goal is to maintain the login service work well
    //But make sure no one would login as admin except you and TA
    //If TA's service check cannot login as admin service will CHECK FAIL
    //Hint: This function is dangerous! Take care of it!
    char tmp[128];
    char flag[128];
    int i=0;
    FILE* f=fopen(FLAGPATH, "r");//openflag for service check
    if(f!=NULL)
    {
        char ch;
        while((ch=fgetc(f))!=EOF)
            flag[i++]=ch;
        flag[i]='\0';
        i=0;
        fclose(f);
    }
    else
    {
        printf("Open flag error\n");
        return;
    }

    printf("Login as: ");
    fflush(stdout);
    fgets(tmp, sizeof(tmp), stdin);
    tmp[strlen(tmp)-1]='\0';//replace '\n' with '\0'
    for(i=0;i<strlen(tmp);++i)//simple check for user input
    {
        if((int)tmp[i]<0x20 || (int)tmp[i]>=0x7e)//non-printable
        {
            printf("Non-printable character is not allow!\n");
            fflush(stdout);
            exit(1);
        }
        
    }
	// TODO tmp length > username
    strncpy(username, tmp, 24);//If check is fine 
	username[23] = '\0';
    if(strcmp(username, "admin")==0)//Hanlding admin login
    {
        printf("Password: ");
        fflush(stdout);
        fgets(tmp, sizeof(tmp), stdin);
        tmp[strlen(tmp)-1]='\0';//replace '\n' with '\0'
        for(i=0;i<strlen(tmp);++i)//simple check for user input
        {
            if((int)tmp[i]<0x20 || (int)tmp[i]>=0x7e)//non-printable
            {
                printf("Non-printable character is not allow!\n");
                fflush(stdout);
                exit(1);
            }
        }
		// TODO tmp length > password
        strncpy(password, tmp, 64);//If check is fine
		password[63] = '\0';
        if(strcmp(password, ADMIN_PASSWORD)==0)//For you to login
            auth=1;
        else if(strcmp(password, flag)==0)//For TA to login
            auth=1;
        else
            auth=0;
    }
    return;
}

void initial_pinfo()
{
    //push username into linked-list head
    //TA's linked-list skill is broken
    //You need to careful what TA writing
	// TODO allocate for next?
	// pf->next = (struct pinfocard)malloc(sizeof(struct pinfocard))
	    //I hate linked-list. But it is fun?
    struct pinfocard* newcard = (struct pinfocard*) malloc(sizeof(struct pinfocard));
    newcard->next=NULL;
    if(tmp!=NULL)
    {
        while(tmp->next!=NULL)
           tmp=tmp->next; 
        tmp->next=newcard;
    }
    else
        pf=newcard;
	// TODO msg larger than buff
    memcpy(newcard->buff, username, sizeof(username)/sizeof(char));//put message onto linked-list
    return;
    /*memcpy(pf->buff, username, sizeof(username)/sizeof(char));
    pf->next=NULL;
    return;*/
}


//main.o call this function and pass the buffer address
//main.o pass two address value to check for buffer overflow of the caller function
//TA think this is a very good secure programming skill
//With this defense it is impossible for client to do buffer overflow
void changemoney(char buffer[], unsigned int bufhead, unsigned int ret) //choice=1
{
    //This is the function to change real money to virtual money
    //Since TA is so bad at Operating System!
    //You need to make sure money will not become negative otherwise system will crash
    //Then all the information will be leaked
    printf("Now you have real money: %d\n", real_money);
    printf("Now you have virtual money: %d\n", virtual_money);
    printf("How much real money do you want to change to virual money\nInput: ");
    fflush(stdout);
	// TODO buffer size too large? be careful
	// TODO fgets(buffer, 10, stdin); since int maximum 10 digits?avoid integer overflow
	// TODO buffer 64 bit
    fgets(buffer, 10, stdin);
	buffer[63] = '\0';
	// TODO add \0 at the end of buffer
    printf(" Changing ");
	// TODO printf no format string?
    printf("%s",buffer);
    fflush(stdout);
    if(atoi(buffer)<0)
    {
        printf("No negtive money\n");
        fflush(stdout);
    }
    else
    {
        if(real_money-atoi(buffer)<0)//Client cannot cheat us
        {
            printf("Sorry, you do not have that much\n");
            fflush(stdout);
        }
        else//1:1 change rate
        {
			real_money-=atoi(buffer);            
			// TODO check for integer overflow
			if ((virtual_money >= 0 && atoi(buffer) > INT_MAX - virtual_money))
			{
				printf("Sorry, Integer overflow\n");
				virtual_money = INT_MAX;
				
			}
			else
			{
				virtual_money+=atoi(buffer);
			}

            printf("Now you have real money: %d\n", real_money);
            printf("Now you have virtual money: %d\n", virtual_money);//integer overflow
            fflush(stdout);
        }
    }

    if(abs(bufhead-ret) < strlen(buffer) ||  abs(bufhead-(ret-4))<strlen(buffer)) //strlen or u can fake bufhead or ret
    {//check if run over return address or ebp
        printf("\n##### Never try to do buffer overflow on my service #####\n");
        fflush(stdout);
        exit(1);
    }
    return;
}

void changeback()
{
    //The fucntion to change virtual money back to real money
    char filepath[128]="";//for filepath under /tmp/
    if(virtual_money>99999)
    {
        printf("You done a good job. After we pay back money. There is a chance for you to read any file under /tmp/ you want\n");
        printf("For example, If you want to view /tmp/test. Just input \"test\"\n"); 
        printf("But I'm sorry! I won't let you read any file which file name with 'flag'\n");
        printf("Exchangeing money....\n");
        printf("Here is your money %d, Choose a file and have a nice day!\n", virtual_money);
		// TODO check integer overflow
        /*real_money+=virtual_money;
        if(real_money > INT_MAX || real_money < 0)//No integer overflow on real_money
            real_money = INT_MAX;*/
		if ((real_money >= 0 && virtual_money > INT_MAX - real_money))
		{
			printf("Sorry, Integer overflow\n");
			real_money = INT_MAX;
		}
		else
		{
			real_money+=virtual_money;
		}
        virtual_money=0;
        printf("Filepath(/tmp/[Input]):");
        fflush(stdout);
		// TODO scanf %s might be dangerous overflow 128 char
		fgets(filepath, sizeof(filepath), stdin);
		tmp[strlen(filepath)-1]='\0';//replace '\n' with '\0'
        //scanf("%s", &filepath); //get client's input 
        if(strstr(filepath,"flag")!=NULL)//if they input some 'flag'
        {
            printf("Sorry. I said that! No flag please...\n");
            fflush(stdout);
            return;
        }
        else if(strstr(filepath,"|")!=NULL || strstr(filepath,"<")!=NULL || strstr(filepath,">")!=NULL)//if they input some 'flag'
        {
            printf("Sorry. No redirect...\n");
            fflush(stdout);
            return;
        }
        else
        {
            char cmd[128];
            strcpy(cmd, "cat /tmp/");//read file for client
			// TODO filter dirty input? might pipe to commands other than cat
			if(strlen(filepath) < 119)
				strncat(cmd, filepath, strlen(filepath));
			else
				strncat(cmd, filepath, 118);
            system(cmd);
        }
    }
    else if(virtual_money>=0&&virtual_money<=99999)//No bonus work for client
    {
        printf("Exchangeing money....\n");
        printf("Here is your money %d\n", virtual_money);
        fflush(stdout);
		// TODO interger overflow
        /*real_money += virtual_money;
        if(real_money > INT_MAX || real_money < 0)//No integer overflow on real_money
            real_money=INT_MAX;*/
		if ((real_money >= 0 && virtual_money > INT_MAX - real_money))
		{
			printf("Sorry, Integer overflow\n");
			real_money = INT_MAX;
		}
		else
		{
			real_money+=virtual_money;
		}
        virtual_money=0;
    }
    else
    {
        printf("Your money is minus... so strange.....\n");
        fflush(stdout);
    }
    return;
}


int betting()
{
    //Gambling system
    //Client can play this and gain virtual money
    //This function is secure... at least to TA's knowledge..
    printf("******SSP Gambling System******\n");
    while(1)
    {
        srand(time(NULL));
        int ans=0, guess=0, betval=0, seed=0;
        char input[8];
        if(virtual_money<=0)//Should pay for money to play
        {
            printf("Uh.. Not enough money");
            fflush(stdout);
            break;
        }
        printf("Money: %d\n", virtual_money);

        printf("How much you want to bet?(\"q\" for leaving)\n Bet:");
        fflush(stdout);
        fgets(input, sizeof(input)/sizeof(char), stdin);
        input[strlen(input)-1]='\0';
		// TODO check dirty input? will it cause atoi() dead? or catch exception
        if(strcmp(input, "q")==0)//leaving
        {
            printf("Bye bye... \n");
            fflush(stdout);
            break;
        }
        betval=atoi(input);
        if(betval<=0 || betval > virtual_money)//some bad input
        {
            printf("Error in bet money. See you\n");
            fflush(stdout);
            break;
        }
        virtual_money-=betval;

        printf("Give me a seed! I will generate a random value [0,seed)!\n Seed:");
        fflush(stdout);
        fgets(input, sizeof(input)/sizeof(char), stdin);
        input[strlen(input)-1]='\0';
		// TODO check dirty input? will it cause atoi() dead?  or catch exception		
        seed = atoi(input);
        if(seed<=0)//some bad input
        {
            printf("Something wrong Stop doing that\n");
            fflush(stdout);
            break;
        }

        ans=rand()%(seed); printf("Guess the random value :");
        fflush(stdout);
        fgets(input, sizeof(input)/sizeof(char), stdin);
        input[strlen(input)-1]='\0';
		// TODO check dirty input? will it cause atoi() dead?  or catch exception
        guess=atoi(input);
        if(ans==guess)//if client guess right
        {
            printf("Congratulations you guess right\n");
            fflush(stdout);
            virtual_money+=betval;
			// TODO interger overflow?
			if ((virtual_money >= 0 && (seed*betval) > INT_MAX - virtual_money))
			{
				printf("Sorry, Integer overflow\n");
				virtual_money = INT_MAX;
			}
			else
			{
				virtual_money+=(seed*betval);
			}
            
        }
        else//clienet guess wrong
        {
            printf("Sorry you are unlucky\n");
            fflush(stdout);
        }
    }
    return;
}

//main.o will output some information
//TA suggest not to modify it...
void displaynmodifyinfo()//means display and modify information
{
    //The function is to let client maintain and see his information
    struct pinfocard* tmp = pf;
    char input;
    char newbuffer[24];
    printf("\nModify information?(y/n)");//If client wants to modify info
    fflush(stdout);
    scanf("%c", &input);
    getchar();
    if(input=='y')//If user gonna modify
    {
        while(1)
        {//from linked-list's head
            printf("Information:%s\n", tmp->buff);
            printf("New string(\"\\n\" means not to modify this node):");
            fflush(stdout);
            fgets(newbuffer, sizeof(newbuffer), stdin);
            newbuffer[strlen(newbuffer)-1]='\0';

            if(strlen(newbuffer)!=0)//modify
                memcpy(tmp->buff, newbuffer, strlen(newbuffer)+1);

            if(tmp->next!=NULL)
                tmp=tmp->next;
            else
                break;
        }
    }
    
    return;
}

void leavemsg()
{
    //The fucntion for user to leave message
    //We will push the message onto linked-list
    char msg[100];
    struct pinfocard* tmp = pf;
    printf("\nLeave Some message:");
    fflush(stdout);
    fgets(msg, 100, stdin);
	msg[99] = '\0';
	// TODO add /0 at tail?
    printf("Your message is follow:\n");
	// TODO printf no format string
    printf("%s",msg);
    fflush(stdout);
    msg[strlen(msg)-1]='\0';
    
    //I hate linked-list. But it is fun?
    struct pinfocard* newcard = (struct pinfocard*) malloc(sizeof(struct pinfocard));
    newcard->next=NULL;
    if(tmp!=NULL)
    {
        while(tmp->next!=NULL)
           tmp=tmp->next; 
        tmp->next=newcard;
    }
    else
        pf=newcard;
	// TODO msg larger than buff
    memcpy(newcard->buff, msg, 24);//put message onto linked-list
	newcard->buff[23] = '\0'
    return;
}

void Million()
{
    //A little game for user to gain virtual money
    //TA also will play this for service check
    int size=2;
    unsigned char digest[16];
    const char charset[]="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";//random base
    unsigned char str[size+1];
    unsigned char md5string[33];
    unsigned char buffer[size+1];
    srand(time(NULL));

    printf("Wellcome to Million Dollars Primary School\n");
    printf("Rules: I will give you MD5(secrect), If you can answer the secrect. I will give you 100 Million!!\n");
    printf("Hint: The secrect is only two bytes\n");
    printf("Hint: The secrect is in [0-9a-zA-Z]\n");
    printf("Money: %d\n", virtual_money);
    fflush(stdout);

    if(size)
    {
        int i=0;
        for(i=0; i<size; ++i)
        {
            int key = rand() % (int)(sizeof(charset) -1) ;
            str[i]=charset[key];
        }
        str[size]='\0';
    }
    //printf("%s\n", str);
    MD5(str, strlen(str), digest);//using openssl md5
    int i=0;
    for(i=0;i<MD5_DIGEST_LENGTH;++i)
        snprintf(&md5string[i*2],16*2, "%02x", (unsigned int) digest[i]);

    printf("MD5 string: %s\n", md5string);
    printf("Enter secret: ");
    fflush(stdout);
    fgets(buffer, 3, stdin);
    buffer[size]='\0';
    if(strcmp(buffer, str)==0)
    {
        printf("Good job! money+10000000\n");
		// TODO interger overflow
        //virtual_money+=100000000;
		if ((virtual_money >= 0 && 100000000 > INT_MAX - virtual_money))
		{
			printf("Sorry, Integer overflow\n");
			virtual_money = INT_MAX;
		}
		else
		{
			virtual_money+=100000000;
		}
        printf("Money: %d\n", virtual_money);
        fflush(stdout);
    }
    else
    {
        printf("Oops.. I am sorry...\n");
        fflush(stdout);
    }
    return;
}
