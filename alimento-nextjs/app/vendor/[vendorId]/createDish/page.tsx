
import { CreateDishForm } from "./components/postDishForm";

const DishPage = () => {
  
  return (
    <div className="flex-col">
      <div className="flex-1 space-y-4 p-8 pt-6">
        <CreateDishForm/>
      </div>
    </div>
  );
};

export default DishPage;
