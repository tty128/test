import { Request, Response, Router } from 'express'
const router : Router = Router();

/* GET home page. */
router.get('/', (_req: Request, res: Response) => {
  res.render('index', { title: 'Express' });
});

export default router