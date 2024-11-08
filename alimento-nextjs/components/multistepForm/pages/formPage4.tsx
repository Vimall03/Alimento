import ImageUpload from '@/components/ui/imageUpload';
import { useGlobalDish } from '@/context/dishFormContext';

const FormPage4 = () => {
  const { imageUrl, handleImageChange, handleImageRemove } = useGlobalDish();

  return (
    <div className="h-3/4 flex mb-5 flex-col items-start gap-8 justify-start">
      <h1 className="text-primary-marineBlue font-bold text-[1.6rem] md:text-4xl leading-9">
        Add Images
      </h1>
      <h3 className="text-gray-400 mt-2 ">
        Please add some images for your listing
        <br />
      </h3>
      <ImageUpload
        value={imageUrl.map(imageUrl => imageUrl)}
        onChange={handleImageChange}
        onRemove={handleImageRemove}
      />
    </div>
  );
};

export default FormPage4;
