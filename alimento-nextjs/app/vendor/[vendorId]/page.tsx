import prismadb from '@/lib/prismadb';
import { Dish } from '@prisma/client';

interface VendorPageProps {
  params: {
    vendorId: string;
  };
}

const VendorPage: React.FC<VendorPageProps> = async ({ params }) => {
  let Dishes: Dish[] | null = [];

  const { vendorId } = await params;
  try {
    Dishes = await prismadb.dish.findMany({
      where: {
        vendorId: vendorId,
      },
    });
  } catch (err) {
    console.error(
      'Error fetching Dishes',
      err instanceof Error ? err.message : err
    );
  }

    if (Dishes.length){
       return <div>this will be the dishes page</div>
    }
  
    else{
      // return <SetUpDishes VendorId={vendorId}/>
      // here the guided form component will be added s
    }
 
}
 
export default VendorPage;
