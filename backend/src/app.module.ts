import {Logger, Module} from '@nestjs/common';
import { TypeOrmModule } from '@nestjs/typeorm';
import { AppController } from './app.controller';
import { AppService } from './app.service';
import { CoursesModule } from './courses/courses.module';
import {Course} from "./courses/course.entity";
import * as path from "path";

const databasePath = path.resolve(__dirname, '../../database.sqlite3')
Logger.log(`Loading database at: ${databasePath}`)


@Module({
  imports: [
    TypeOrmModule.forRoot({
      type: 'sqlite',
      database: databasePath,
      logging: true,
      entities: [
       Course
      ],
      synchronize: true,
    }),
    CoursesModule,
  ],
  controllers: [AppController],
  providers: [AppService],
})
export class AppModule {}
