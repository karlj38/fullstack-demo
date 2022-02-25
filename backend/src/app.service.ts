import { Injectable } from '@nestjs/common';

@Injectable()
export class AppService {
  getHello(): string {
    // TODO: Chaneg to whichever message you feel appropriate
    return 'Hello World!';
  }
}
