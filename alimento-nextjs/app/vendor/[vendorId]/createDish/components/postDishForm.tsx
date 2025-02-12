"use client";
import { zodResolver } from "@hookform/resolvers/zod";
import { useParams, useRouter } from "next/navigation";
import { useCallback, useState } from "react";
import { useForm } from "react-hook-form";
import toast from "react-hot-toast";
import * as z from "zod";

import { Button } from "@/components/ui/button";
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from "@/components/ui/form";
import { Heading } from "@/components/ui/heading";
import ImageUpload from "@/components/ui/imageUpload";
import { Input } from "@/components/ui/input";
import { Separator } from "@/components/ui/separator";
import { createDish } from "@/actions/dish/dishCREATE";
import TagSelectorCreateDish from "@/components/vendor/tagSelectorCreateDishForm";

const formSchema = z.object({
  name: z.string().min(1, "Name is required"),
  price: z.number().min(0, "Price must be a positive number"),
  description: z.string().min(1, "Description is required"),
  category: z.enum(
    ["APPETIZER", "MAIN_COURSE", "DESSERT", "BEVERAGE", "SNACK"],
    {
      errorMap: () => ({ message: "Category is required" }),
    }
  ),
  tags: z.array(z.enum([
    "SPICY",
    "VEGETARIAN",
    "VEGAN",
    "GLUTEN_FREE",
    "DAIRY_FREE",
    "NUT_FREE",
    "INDIAN",
    "CHINESE",
    "ITALIAN",
    "ARABIC",
  ])).min(1, "Atleast 1 tag is required"),
  images: z.array(z.string()).min(1, "At least one image is required"),
});

type CreateDishFormValues = z.infer<typeof formSchema>;

export const CreateDishForm: React.FC = () => {
  const params = useParams();
  const router = useRouter();
  const [loading, setLoading] = useState(false);

  const title = "Create Dish";
  const description = "Fill in the details to create a new Dish.";
  const toastMessage = "Dish created.";
  const action = "Create";

  const form = useForm<CreateDishFormValues>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      name: "",
      price: 0,
      description: "",
      category: "APPETIZER",
      tags: [],
      images: [],
    },
  });

  const onSubmit = async (data: CreateDishFormValues) => {
    try {
      if (!params.vendorId) {
        toast.error("vendorId is required!");
        return;
      }

      const vendorId = Array.isArray(params.vendorId)
        ? params.vendorId[0]
        : params.vendorId;

      if (!vendorId) {
        toast.error("Valid vendorId is required!");
        return;
      }

      setLoading(true);

      console.log(data,vendorId)
      await createDish({
        vendorId: vendorId,
        name : data.name,
        description :data.description,
        price : data.price,
        category : data.category,
        tags : data.tags,
        images : data.images
      });

      router.push(`/vendor/${vendorId}/`);
      toast.success(toastMessage);
    } catch (err) {
      toast.error("Something went wrong");
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  // Handle image change
  const handleImageChange = useCallback(
    (url: string) => {
      form.setValue("images", [...form.getValues("images"), url]);
    },
    [form]
  );

  // Handle image removal
  const handleImageRemove = useCallback(
    (url: string) => {
      const updatedImages = form
        .getValues("images")
        .filter((image) => image !== url);
      form.setValue("images", updatedImages);
    },
    [form]
  );

  return (
    <>
      <div className="flex items-center justify-between">
        <Heading title={title} description={description} />
      </div>
      <Separator />

      <Form {...form}>
        <form
          onSubmit={form.handleSubmit(onSubmit)}
          className="space-y-8 w-full"
        >
          <FormField
            control={form.control}
            name="images"
            render={({ field }) => (
              <FormItem>
                <FormLabel>Images</FormLabel>
                <FormControl>
                  <ImageUpload
                    value={field.value}
                    disabled={loading}
                    onChange={handleImageChange}
                    onRemove={handleImageRemove}
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            )}
          />

          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            <FormField
              control={form.control}
              name="name"
              render={({ field }) => (
                <FormItem>
                  <FormLabel>Name</FormLabel>
                  <FormControl>
                    <Input
                      disabled={loading}
                      placeholder="Dish Name"
                      {...field}
                    />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />
            <FormField
              control={form.control}
              name="price"
              render={({ field }) => (
                <FormItem>
                  <FormLabel>Price</FormLabel>
                  <FormControl>
                    <Input
                      type="number"
                      disabled={loading}
                      placeholder="Price"
                      {...field}
                      // Ensure value is a number and valid for form submission
                      onChange={(e) => {
                        const value = parseFloat(e.target.value);
                        field.onChange(isNaN(value) ? 0 : value);
                      }}
                    />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />
            <FormField
              control={form.control}
              name="description"
              render={({ field }) => (
                <FormItem>
                  <FormLabel>Description</FormLabel>
                  <FormControl>
                    <Input
                      disabled={loading}
                      placeholder="Description"
                      {...field}
                    />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />
            <FormField
              control={form.control}
              name="category"
              render={({ field }) => (
                <FormItem>
                  <FormLabel>Category</FormLabel>
                  <FormControl>
                    <select
                      disabled={loading}
                      {...field}
                      className="border rounded-md p-2"
                    >
                      <option value="" disabled>
                        Select a category
                      </option>
                      <option value="APPETIZER">Appetizer</option>
                      <option value="MAIN_COURSE">Main Course</option>
                      <option value="DESSERT">Dessert</option>
                      <option value="BEVERAGE">Beverage</option>
                      <option value="SNACK">Snack</option>
                    </select>
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />

            <FormField
              control={form.control}
              name="tags"
              render={({ field }) => (
                <FormItem>
                  <FormLabel>Tags</FormLabel>
                  <FormControl>
                    <TagSelectorCreateDish
                      dishTags={field.value}
                      setDishTags={(tags) => field.onChange(tags)}
                      disabled={loading}
                    />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />
          </div>

          <Button disabled={loading} className="ml-auto" type="submit">
            {action}
          </Button>
        </form>
      </Form>
      <Separator />
    </>
  );
};
